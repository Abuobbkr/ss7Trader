<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- SweetAlert2 for beautiful alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jQuery Validate for form validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<!-- Toastr for notifications (if you use it, ensure it's linked in layouts/app.blade.php) -->
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

<script>

    $(document).ready(function () {

        // Initialize DataTable
        var table = $('#assets-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('assets.getData') }}",
                beforeSend: function () {
                    $('#table-loading-overlay').fadeIn(200);
                },
                complete: function () {
                    $('#table-loading-overlay').fadeOut(200);
                },
                type: "GET"
            },
            columns: [
                { data: 'serial_number', name: 'serial_number' },
                { data: 'created_at', name: 'created_at' },
                { data: 'pair_name', name: 'pair_name' },
                { data: 'market_type', name: 'market_type' },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        // The controller already renders the buttons, so just return data
                        return data;
                    }
                }
            ]
        });

        // Current asset ID for edit/delete operations
        let currentAssetId = null;

        // Edit button click handler
        $(document).on('click', '.edit-asset', function () {
            console.log("Edit asset button clicked.");
            const assetId = $(this).data('id');
            currentAssetId = assetId; // Store for form submission

            // Show loading indicator in modal
            $('#assetModal .modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

            // Fetch asset data
            $.ajax({
                url: `/assets/${assetId}/edit`, // Use the correct route for editing
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        const asset = response.data;
                        console.log("Asset data fetched for edit:", asset);

                        // Populate the form fields
                        $('#asset-form input, #asset-form select').each(function () {
                            const name = $(this).attr('name');
                            if (asset[name] !== undefined) {
                                if ($(this).attr('type') === 'datetime-local' && asset[name]) {
                                    // Format timestamp for datetime-local input
                                    const date = new Date(asset[name]);
                                    const formattedDate = date.getFullYear() + '-'
                                        + ('0' + (date.getMonth() + 1)).slice(-2) + '-'
                                        + ('0' + date.getDate()).slice(-2) + 'T'
                                        + ('0' + date.getHours()).slice(-2) + ':'
                                        + ('0' + date.getMinutes()).slice(-2);
                                    $(this).val(formattedDate);
                                } else {
                                    $(this).val(asset[name]);
                                }
                            }
                        });

                        // Set form to edit mode
                        $('#asset-form')
                            .attr('data-mode', 'edit')
                            .attr('data-id', assetId);

                        // Update modal title
                        $('#assetModalLabel').text('Edit Asset');

                        // Show the modal
                        $('#assetModal').modal('show');
                    } else {
                        Swal.fire('Error!', response.message, 'error'); // Using SweetAlert2
                    }
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Failed to fetch asset data';
                    console.error("Error fetching asset data:", xhr.responseText);
                    Swal.fire('Error!', errorMessage, 'error');
                },
                complete: function () {
                    $('.modal-overlay').remove(); // Hide loading indicator
                }
            });
        });

        // Initialize form validation

        // Delete button click handler
        $(document).on('click', '.delete-asset', function () {
            console.log("Delete asset button clicked.");
            const assetId = $(this).data('id');
            currentAssetId = assetId; // Store for confirmation modal

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete this asset. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading indicator
                    $('#assets-table').append('<div id="table-loading-overlay-delete" class="overlay-backdrop"><div class="overlay-spinner"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div></div>');

                    $.ajax({
                        url: `/assets/${currentAssetId}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE' // Laravel needs this for route model binding
                        },
                        success: function (response) {
                            console.log("Delete AJAX success response:", response);
                            if (response.success) {
                                Swal.fire('Deleted!', response.message, 'success');
                                table.ajax.reload(null, false); // Reload DataTable
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'Failed to delete asset';
                            console.error("Delete AJAX error response:", xhr.responseText);
                            Swal.fire('Error!', errorMessage, 'error');
                        },
                        complete: function () {
                            $('#table-loading-overlay-delete').remove(); // Hide loading indicator
                        }
                    });
                }
            });
        });

        // Reset form function
        function resetForm() {
            console.log("Resetting form.");
            $('#asset-form')[0].reset();
            $('#asset-form').removeAttr('data-mode').removeAttr('data-id');
            $('#asset-form').find('.is-invalid').removeClass('is-invalid');
            $('#asset-form').find('.is-valid').removeClass('is-valid');
            $('#asset-form').find('label').removeClass('text-danger');
            // If you have select2, trigger change to reset its display
            if ($.fn.select2) {
                $('.form-select').trigger('change');
            }
        }

        // Clear validation and reset form on modal hide
        $('#assetModal').on('hidden.bs.modal', function () {
            console.log("Asset modal hidden, resetting form.");
            resetForm();
        });
    });



    $(document).ready(function () {
        // Initialize form validation
        console.log('Initializing form validation');
        // Initialize form validation
        console.log('Initializing form validation');
        $('#asset-form').validate({
            rules: {
                pair_name: {
                    required: true,
                    maxlength: 255
                },
                market_type: {
                    required: true,
                },
                asset_image: {
                    // 'required: true' if the image is mandatory for creation.
                    // If it's optional, remove 'required: true'.
                    required: true,
                    // For file inputs, maxlength doesn't apply to the file itself,
                    // only potentially to a text input where a path is entered.
                    // You handle file size and type validation on the server.
                    // Remove 'maxlength: 255' for file inputs in client-side validation.
                },
                timestamp: { // Add timestamp rule if it's an input in your form
                    date: true // Validates if the input is a valid date
                }
            },
            messages: {
                pair_name: {
                    required: "Please enter the pair name.",
                    maxlength: "Pair name cannot exceed 255 characters."
                },
                market_type: {
                    required: "Please select a market type."
                },
                asset_image: {
                    required: "Please select an image to upload.", // Message for required file
                    // Remove maxlength message as it's not applicable to file input.
                },
                timestamp: { // Add timestamp message
                    date: "Please enter a valid date and time."
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
                $(element).closest('.col-md-6').find('label').addClass('text-danger');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                $(element).closest('.col-md-6').find('label').removeClass('text-danger');
            },
            errorPlacement: function (error, element) {
                if (element.attr('type') === 'checkbox') {
                    error.insertAfter(element.closest('.form-check'));
                } else if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.is('select') || element.attr('type') === 'file') { // Explicitly handle select and file inputs
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form, event) {
                console.log("Form submitHandler triggered!");
                event.preventDefault(); // Prevent default browser form submission

                // --- CRUCIAL CHANGE FOR FILE UPLOADS ---
                // Use FormData to handle file inputs along with other form data.
                const formData = new FormData(form);

                const isEditMode = $(form).attr('data-mode') === 'edit';
                const assetId = $(form).attr('data-id');
                let url = '/assets'; // Default URL for creation
                let method = 'POST'; // Always use POST for file uploads via AJAX

                if (isEditMode) {
                    url = `/assets/${assetId}`;
                    // When sending PUT/PATCH via FormData, Laravel needs a _method field.
                    formData.append('_method', 'PUT'); // Add spoofing for PUT request
                    // If your backend expects PATCH, change 'PUT' to 'PATCH'
                }

                console.log(`Submitting form: URL=${url}, Method=${method}`);
                // For debugging FormData content:
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}:`, value);
                }

                $('#assetModal .modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

                $.ajax({
                    url: url,
                    type: method, // Will be POST, with _method=PUT/PATCH for updates
                    data: formData, // Send FormData object
                    processData: false, // Tell jQuery not to process the data (already FormData)
                    contentType: false, // Tell jQuery not to set content type (FormData handles it)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log("AJAX success response:", response);
                        if (response.success) {
                            Swal.fire('Success!', response.message, 'success');
                            $('#assetModal').modal('hide');
                            if (typeof table !== 'undefined' && table.ajax) {
                                table.ajax.reload(null, false);
                            }
                            if (typeof resetForm === 'function') {
                                resetForm();
                            }
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = xhr.responseJSON?.message || 'An unexpected error occurred.';
                        if (xhr.responseJSON?.errors) {
                            errorMessage = '';
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                errorMessage += value + '<br>';
                            });
                        }
                        console.error("AJAX error response:", xhr.responseText);
                        Swal.fire('Error!', errorMessage, 'error');
                    },
                    complete: function () {
                        $('.modal-overlay').remove();
                    }
                });
            }
        });

        // --- Optional: Custom Validation Methods (Uncomment if needed) ---
        // If you need a 'string' rule to enforce non-empty string or specific characters:
        /*
        if (!$.validator.methods.string) {
            $.validator.addMethod("string", function(value, element) {
                // This simple example just checks if it's a string and not empty.
                // You might want a more complex regex for specific string formats.
                return this.optional(element) || (typeof value === "string" && value.trim().length > 0);
            }, "Please enter a valid string.");
        }
        */

        // 'nullable' is generally handled by omitting 'required'.
        // A custom 'nullable' rule would only be needed if you have complex conditional logic.
        /*
        if (!$.validator.methods.nullable) {
            $.validator.addMethod("nullable", function(value, element) {
                return true; // Always passes, as it indicates the field is optional.
            }, "");
        }
        */

        // Function to reset the form - ensure this is defined globally or within a scope accessible here
        // Example:
        function resetForm() {
            $('#asset-form')[0].reset(); // Resets all form fields
            $('#asset-form').validate().resetForm(); // Clears validation messages and styles
            $('#asset-form').find('.is-invalid, .is-valid').removeClass('is-invalid is-valid'); // Remove Bootstrap validation classes
            $('#asset-form').find('label.text-danger').removeClass('text-danger'); // Remove label error styling
            $('#asset-form').attr('data-mode', 'create').removeAttr('data-id'); // Reset form mode
            $('#AssetModalLabel').text('Create New Asset'); // Reset modal title
        }

        // You'll likely need event listeners to open the modal and set its mode for edit/create
        // Example for opening create modal:
        // $('#createAssetBtn').on('click', function() {
        //     resetForm();
        //     $('#assetModal').modal('show');
        // });

        // Example for opening edit modal (assuming you have an edit button that sets data-id and data-mode)
        // $('.edit-asset-btn').on('click', function() {
        //     const id = $(this).data('id');
        //     // Fetch asset data for editing and populate the form
        //     // Then set form attributes:
        //     $('#asset-form').attr('data-mode', 'edit').attr('data-id', id);
        //     $('#AssetModalLabel').text('Edit Asset');
        //     $('#assetModal').modal('show');
        // });
    });

</script>
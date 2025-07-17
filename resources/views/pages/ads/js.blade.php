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
            var table = $('#ads-side-table').DataTable({
                processing: true, // Show a processing indicator
                serverSide: true, // Enable server-side processing for large datasets
                ajax: {
                    // The URL to fetch data from your AdController's getData method
                    url: "{{ route('ads.getSidebarData') }}",
                    type: "GET", // Use GET request for fetching data
                    beforeSend: function () {
                        // Show a loading overlay before the AJAX request is sent
                        $('#table-loading-overlay').fadeIn(200);
                    },
                    complete: function () {
                        // Hide the loading overlay when the AJAX request is complete
                        $('#table-loading-overlay').fadeOut(200);
                    },
                },
                columns: [
                    // Column for serial number, directly mapped from the 'id' returned by the controller
                    { data: 'serial_number', name: 'serial_number' },
                    // Column for creation timestamp
                    { data: 'created_at', name: 'created_at' },
                    // Column for Sidebar Image, rendered as an HTML image tag by the controller
                    { data: 'sidebar_image', name: 'sidebar_image', orderable: false, searchable: false },
                    // Column for Banner Image, rendered as an HTML image tag by the controller
                    {
                        // Column for action buttons (Edit, Delete), rendered as HTML by the controller
                        data: 'action',
                        name: 'action',
                        orderable: false, // Actions column should not be sortable
                        searchable: false, // Actions column should not be searchable
                        render: function (data, type, row) {
                            // The controller already provides the full HTML for the buttons,
                            // so we just return the data as is.
                            return data;
                        }
                    }
                ]
            });

            var table = $('#ads-side-table').DataTable({
                processing: true, // Show a processing indicator
                serverSide: true, // Enable server-side processing for large datasets
                ajax: {
                    // The URL to fetch data from your AdController's getData method
                    url: "{{ route('ads.getBannerData') }}",
                    type: "GET", // Use GET request for fetching data
                    beforeSend: function () {
                        // Show a loading overlay before the AJAX request is sent
                        $('#table-loading-overlay').fadeIn(200);
                    },
                    complete: function () {
                        // Hide the loading overlay when the AJAX request is complete
                        $('#table-loading-overlay').fadeOut(200);
                    },
                },
                columns: [
                    // Column for serial number, directly mapped from the 'id' returned by the controller
                    { data: 'serial_number', name: 'serial_number' },
                    // Column for creation timestamp
                    { data: 'created_at', name: 'created_at' },
                    // Column for Sidebar Image, rendered as an HTML image tag by the controller
                    { data: 'banner_image', name: 'banner_image', orderable: false, searchable: false },
                    // Column for Banner Image, rendered as an HTML image tag by the controller
                    {
                        // Column for action buttons (Edit, Delete), rendered as HTML by the controller
                        data: 'action',
                        name: 'action',
                        orderable: false, // Actions column should not be sortable
                        searchable: false, // Actions column should not be searchable
                        render: function (data, type, row) {
                            // The controller already provides the full HTML for the buttons,
                            // so we just return the data as is.
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
        console.log("Initializing form validation for ads-form.");
        $('#ads-sidebar-form').validate({
            rules: {
                // 'sidebar_image' and 'banner_image' are nullable in the backend,
                // so they are not strictly 'required' for client-side validation
                // unless you want to enforce it for creation.
                // For updates, they are definitely optional.
                sidebar_image: {
                    required: true // Set to true if sidebar image is mandatory for creation
                },
                
            },
            messages: {
                sidebar_image: {
                    required: "Please select a sidebar image."
                },
                
            },
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
                // Adjust selector if label is not directly in col-md-6 or needs different styling
                $(element).closest('.col-md-6').find('label').addClass('text-danger');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                // Adjust selector if label is not directly in col-md-6 or needs different styling
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

                console.log("Form data prepared for AJAX submission:", formData);

                // Determine if it's an edit or create operation
                const isEditMode = $(form).attr('data-mode') === 'edit';
                const adId = $(form).attr('data-id'); // Get the ad ID for updates
                let url = '{{ route("ads.store") }}'; // Default URL for creation
                let method = 'POST'; // Always use POST for file uploads via AJAX

                if (isEditMode) {
                    url = `{{ url('ads') }}/${adId}`; // URL for update (e.g., /ads/1)
                    // When sending PUT/PATCH via FormData, Laravel needs a _method field.
                    formData.append('_method', 'POST'); // Spoof PUT/PATCH method via POST
                    // If your backend expects PATCH, change 'PUT' to 'PATCH' in the controller route
                }

                console.log(`Submitting form: URL=${url}, Method=${method}`);
                // For debugging FormData content:
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}:`, value);
                }

                // Show a loading overlay on the modal
                $('#AdvertismentModal .modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

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
                            $('#AdvertismentModal').modal('hide'); // Hide the modal
                            // Reload the DataTables to show the updated data
                            if (typeof table !== 'undefined' && table.ajax) {
                                table.ajax.reload(null, false);
                            }
                            // Reset the form after successful submission
                            form.reset(); // Resets all form fields
                            // Optionally remove validation classes and messages
                            $('#ads-form').validate().resetForm();
                            $('#ads-form .is-invalid').removeClass('is-invalid');
                            $('#ads-form .is-valid').removeClass('is-valid');
                            $('#ads-form label').removeClass('text-danger');

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
                        // Remove the loading overlay
                        $('.modal-overlay').remove();
                    }
                });
            }
        });


        $('#ads-banner-form').validate({
            rules: {
                // 'sidebar_image' and 'banner_image' are nullable in the backend,
                // so they are not strictly 'required' for client-side validation
                // unless you want to enforce it for creation.
                // For updates, they are definitely optional.
                banner_image: {
                    required: true // Set to true if sidebar image is mandatory for creation
                },
                
            },
            messages: {
                sidebar_image: {
                    required: "Please select a banner image."
                },
                
            },
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
                // Adjust selector if label is not directly in col-md-6 or needs different styling
                $(element).closest('.col-md-6').find('label').addClass('text-danger');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                // Adjust selector if label is not directly in col-md-6 or needs different styling
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

                console.log("Form data prepared for AJAX submission:", formData);

                // Determine if it's an edit or create operation
                const isEditMode = $(form).attr('data-mode') === 'edit';
                const adId = $(form).attr('data-id'); // Get the ad ID for updates
                let url = '{{ route("ads.store") }}'; // Default URL for creation
                let method = 'POST'; // Always use POST for file uploads via AJAX

                if (isEditMode) {
                    url = `{{ url('ads') }}/${adId}`; // URL for update (e.g., /ads/1)
                    // When sending PUT/PATCH via FormData, Laravel needs a _method field.
                    formData.append('_method', 'POST'); // Spoof PUT/PATCH method via POST
                    // If your backend expects PATCH, change 'PUT' to 'PATCH' in the controller route
                }

                console.log(`Submitting form: URL=${url}, Method=${method}`);
                // For debugging FormData content:
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}:`, value);
                }

                // Show a loading overlay on the modal
                $('#AdvertismentModal .modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

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
                            $('#AdvertismentModal').modal('hide'); // Hide the modal
                            // Reload the DataTables to show the updated data
                            if (typeof table !== 'undefined' && table.ajax) {
                                table.ajax.reload(null, false);
                            }
                            // Reset the form after successful submission
                            form.reset(); // Resets all form fields
                            // Optionally remove validation classes and messages
                            $('#ads-form').validate().resetForm();
                            $('#ads-form .is-invalid').removeClass('is-invalid');
                            $('#ads-form .is-valid').removeClass('is-valid');
                            $('#ads-form label').removeClass('text-danger');

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
                        // Remove the loading overlay
                        $('.modal-overlay').remove();
                    }
                });
            }
        });

        
    });

</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>


<script src="{{ asset('js/datatables.js') }}"></script>

<script>


    $(document).ready(function () {

        // Initialize DataTable
        var table = $('#Subscribers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('subscribers.getData') }}",
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
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },

                { data: 'password', name: 'password' },
                { data: 'expire_at', name: 'expire_at' },
                { data: 'created_at', name: 'created_at' },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        // return data;
                        return '<button class="btn btn-sm btn-edit" data-id="' + row.id + '">✏️</button>' +
                            ' <button class="btn btn-sm btn-delete" data-id="' + row.id + '">🗑️</button>';
                    }

                }
            ]
        });



        let currentsubscriberId = null;

        // Edit button click handler
        $(document).on('click', '.btn-edit', function () {
            console.log('Edit button clicked');
            const subscriberId = $(this).data('id');

            // Show loading indicator
            $('#SignalModal .modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

            // Fetch signal data
            $.ajax({
                url: `/subscribers/${subscriberId}/edit`,
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        const signal = response.data;

                        // Populate the form
                        $('#subscriber-form input, #subscriber-form select').each(function () {
                            const name = $(this).attr('name');
                            if (signal[name] !== undefined) {
                                if ($(this).attr('type') === 'checkbox') {
                                    $(this).prop('checked', Boolean(signal[name]));
                                } else {
                                    $(this).val(signal[name]);
                                }
                            }
                        });

                        // Set form to edit mode
                        $('#subscriber-form')
                            .attr('data-mode', 'edit')
                            .attr('data-id', subscriberId);

                        // Update modal title
                        $('#SubscriberModalLabel').text('Edit Subscriber');

                        // Show the modal
                        $('#SubscriberModal').modal('show');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Failed to fetch signal data';
                    toastr.error(errorMessage);
                },
                complete: function () {
                    $('.modal-overlay').remove();
                }
            });
        });



        // Handle form submission


        // Edit button click handler


        // Form submission handler (for both create and update)


        // function resetForm() {
        //     $('#role-form')[0].reset();
        //     $('#role-form').removeAttr('data-mode');
        //     $('#role-form').removeAttr('data-id');
        //     $('button[type="submit"]').text('Submit');
        // }


        // Add this to your existing DataTable initialization code
        $('#signals-table').on('click', '.btn-delete', function () {
            const subscriberId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete this signal.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    // Show loading indicator


                    $.ajax({
                        url: `/signals/${subscriberId}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), // Alternative method
                            _method: 'DELETE' // Laravel needs this for route model binding
                        },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                // Reload DataTable
                                // if ($.fn.DataTable.isDataTable('#signals-table')) {
                                $('#signals-table').DataTable().ajax.reload(null, false);
                                // }
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'Failed to delete signal';
                            toastr.error(errorMessage);
                        },
                        complete: function () {
                            $('.row-overlay').remove();
                        }
                    });
                }
            });

        });


        function deleteSignal(roleId, moduleId) {

            $.ajax({
                url: `/roles/${roleId}?module_id=${moduleId}`,

                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log('Response:', response);  // Check the structure of the response
                    if (response && response.success) {
                        $('#roles-table').DataTable().ajax.reload(null, false);
                        toastr.clear();
                        toastr.success(response.message || 'Role deleted successfully');
                    } else {
                        toastr.clear();
                        toastr.error('Failed to delete the role. Please try again.');
                    }
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON?.message || 'Deletion failed');
                }
            });
        }


        // For editing a signal (populate the form)
        $(document).on('click', '.edit-signal', function () {
            const subscriberId = $(this).data('id');

            $.get(`/signals/${subscriberId}/edit`, function (response) {
                // Populate form fields
                $('[name="pair_name"]').val(response.pair_name);
                $('[name="market_type"]').val(response.market_type);
                $('[name="entry_price"]').val(response.entry_price);
                $('[name="stop_loss"]').val(response.stop_loss);
                $('[name="take_profit"]').val(response.take_profit);
                $('[name="signal_type"]').val(response.signal_type);
                $('[name="group_type"]').val(response.group_type);
                $('#is-open-switch').prop('checked', response.is_open);

                // Set edit mode
                $('#signal-form').attr('data-mode', 'edit').attr('data-id', subscriberId);
                $('#signalModal').modal('show');
            });
        });










    });
    $(document).ready(function () {
        // Initialize form validation
        console.log('Initializing form validation');
        $(document).ready(function () {
            // Initialize validation on the correct form ID
            $('#subscriber-form').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,

                    }
                },
                messages: {
                    username: {
                        required: "Please enter a username",
                        minlength: "Username must be at least 3 characters"
                    },
                    email: {
                        required: "Please enter an email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",

                    }
                },
                errorElement: 'span',
                errorClass: 'text-danger',
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                    $(element).closest('.form-group').find('label').addClass('text-danger');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                    $(element).closest('.form-group').find('label').removeClass('text-danger');
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'checkbox') {
                        error.insertAfter(element.closest('.form-check'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form, event) {
                    event.preventDefault();

                    // Prepare form data
                    const formData = {
                        username: $('[name="username"]').val(),
                        email: $('[name="email"]').val(),
                        password: $('[name="password"]').val(),
                        is_open: $('#is-open-switch').is(':checked') ? 1 : 0,
                        _token: $('meta[name="csrf-token"]').attr('content'), // Alternative method

                    };

                    // Show loading indicator
                    $('.modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

                    // Determine if edit or create
                    const isEditMode = $(form).attr('data-mode') === 'edit';
                    const subscriberId = $(form).attr('data-id');
                    const url = isEditMode ? `/subscribers/${subscriberId}` : '/subscribers';
                    const method = isEditMode ? 'PUT' : 'POST';

                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                $('#SubscriberModal').modal('hide');
                                // if ($.fn.DataTable.isDataTable('#subscribers-table')) {
                                $('#Subscribers-table').DataTable().ajax.reload();
                                // }
                                form.reset();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'An error occurred';
                            if (xhr.responseJSON?.errors) {
                                errorMessage = '';
                                $.each(xhr.responseJSON.errors, function (key, value) {
                                    errorMessage += value + '<br>';
                                });
                            }
                            toastr.error(errorMessage);
                        },
                        complete: function () {
                            $('.modal-overlay').remove();
                        }
                    });
                }
            });

            // Add custom alphanumeric validation rule
            $.validator.addMethod("alphanumeric", function (value, element) {
                return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
            }, "Password must contain only letters and numbers");
        });
        // Reset form function
        function resetForm() {
            $('#signal-form')[0].reset();
            $('#signal-form').removeAttr('data-mode').removeAttr('data-id');
            $('#signal-form').find('.is-invalid').removeClass('is-invalid');
            $('#signal-form').find('.is-valid').removeClass('is-valid');
            $('#signal-form').find('label').removeClass('text-danger');
            $('#is-open-switch').prop('checked', true);

            // Reset select2 if you're using it
            if ($.fn.select2) {
                $('.form-select').trigger('change');
            }
        }

        // Clear validation on modal hide
        $('#signalModal').on('hidden.bs.modal', function () {
            resetForm();
        });
    });

</script>
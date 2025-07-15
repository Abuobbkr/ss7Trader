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
        var table = $('#signals-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('signals.getData') }}",
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
                { data: 'pair_name', name: 'pair_name' },
                { data: 'signal_type', name: 'signal_type' },
                { data: 'entry_price', name: 'entry_price' },
                { data: 'stop_loss', name: 'stop_loss' },
                { data: 'take_profit', name: 'take_profit' },
                { data: 'group_type', name: 'group_type' },
                { data: 'market_type', name: 'market_type' },
                { data: 'status', name: 'status' },
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



        let currentSignalId = null;

        // Edit button click handler
        $(document).on('click', '.btn-edit', function () {
            const signalId = $(this).data('id');

            // Show loading indicator
            $('#SignalModal .modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

            // Fetch signal data
            $.ajax({
                url: `/signals/${signalId}/edit`,
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        const signal = response.data;

                        // Populate the form
                        $('#signal-form input, #signal-form select').each(function () {
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
                        $('#signal-form')
                            .attr('data-mode', 'edit')
                            .attr('data-id', signalId);

                        // Update modal title
                        $('#SignalModalLabel').text('Edit Signal');

                        // Show the modal
                        $('#SignalModal').modal('show');
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
        $('#roles-table').on('click', '.btn-edit', function () {
            // Get data from button attributes
            const roleId = $(this).data('id');
            const moduleId = $(this).data('module');
            const roleName = $(this).data('role');
            const orderNo = $(this).data('orderno');
            const isActive = $(this).data('active');

            // Populate form
            $('#module-select').val(moduleId);
            $('#role-input').val(roleName);
            $('#order-no-input').val(orderNo);
            $('#is-active-checkbox').prop('checked', isActive);

            // Change form to update mode
            $('#role-form').attr('data-mode', 'edit');
            $('#role-form').attr('data-id', roleId);
            $('button[type="submit"]').text('Update');

            // Scroll to form
            $('html, body').animate({
                scrollTop: $('#role-form').offset().top - 20
            }, 500);
        });

        // Form submission handler (for both create and update)


        // function resetForm() {
        //     $('#role-form')[0].reset();
        //     $('#role-form').removeAttr('data-mode');
        //     $('#role-form').removeAttr('data-id');
        //     $('button[type="submit"]').text('Submit');
        // }


        // Add this to your existing DataTable initialization code
        $('#signals-table').on('click', '.btn-delete', function () {
            const signalId = $(this).data('id');

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
                        url: `/signals/${signalId}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), // Alternative method
                            _method: 'DELETE' // Laravel needs this for route model binding
                        },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                // Reload DataTable
                                if ($.fn.DataTable.isDataTable('#signals-table')) {
                                    $('#signals-table').DataTable().ajax.reload(null, false);
                                }
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
            const signalId = $(this).data('id');

            $.get(`/signals/${signalId}/edit`, function (response) {
                // Populate form fields
                $('[name="pair_name"]').val(response.pair_name);
                $('[name="market_type"]').val(response.market_type);
                $('[name="entry_price"]').val(response.entry_price);
                $('[name="stop_loss"]').val(response.stop_loss);
                $('[name="take_profit"]').val(response.take_profit);
                $('[name="signal_type"]').val(response.signal_type);
                $('[name="group_type"]').val(response.group_type);
                $('#is-open-switch').prop('checked', response.is_open);

                // Populate the new premium switches based on the response data
                $('#entry-price-switch').prop('checked', response.entry_price_premium);
                $('#stop-loss-switch').prop('checked', response.stop_loss_premium);
                $('#take-profit-switch').prop('checked', response.take_profit_premium);

                // Set edit mode
                $('#signal-form').attr('data-mode', 'edit').attr('data-id', signalId);
                $('#SignalModal').modal('show'); // Corrected modal ID from signalModal to SignalModal
            });
        });











    });
    $(document).ready(function () {
        // Initialize form validation
        console.log('Initializing form validation');
        $('#signal-form').validate({
            rules: {
                pair_name: {
                    required: true
                },
                signal_type: {
                    required: true
                },
                entry_price: {
                    required: true,
                    number: true,
                    min: 0.00001
                },
                stop_loss: {
                    required: true,
                    number: true,
                    min: 0.00001
                },
                take_profit: {
                    required: true,
                    number: true,
                    min: 0.00001
                },
                group_type: {
                    required: true
                }
            },
            messages: {
                pair_name: {
                    required: "Please select a currency pair"
                },
                signal_type: {
                    required: "Please select signal type"
                },
                market_type: {
                    required: "Please select market type"
                },
                entry_price: {
                    required: "Please enter entry price",
                    number: "Please enter a valid number",
                    min: "Price must be greater than 0"
                },
                stop_loss: {
                    required: "Please enter stop loss",
                    number: "Please enter a valid number",
                    min: "Price must be greater than 0"
                },
                take_profit: {
                    required: "Please enter take profit",
                    number: "Please enter a valid number",
                    min: "Price must be greater than 0"
                },
                group_type: {
                    required: "Please select group type"
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid')
                    .removeClass('is-valid')
                    .closest('.form-group')
                    .find('label')
                    .addClass('text-danger');

                // For select2 elements if you have them
                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('.select2-container').find('.select2-selection').addClass('is-invalid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid')
                    .addClass('is-valid')
                    .closest('.form-group')
                    .find('label')
                    .removeClass('text-danger');

                // For select2 elements if you have them
                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('.select2-container').find('.select2-selection').removeClass('is-invalid');
                }
            },
            errorPlacement: function (error, element) {
                // For checkbox/switch
                if (element.attr('type') === 'checkbox') {
                    error.insertAfter(element.closest('.form-check'));
                }
                // For select2 elements if you have them
                else if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                }
                // Default placement
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form, event) {
                event.preventDefault();

                // Prepare form data
                const formData = {
                    pair_name: $('[name="pair_name"]').val(),
                    signal_type: $('[name="signal_type"]').val(),
                    market_type: $('[name="market_type"]').val(),
                    entry_price: $('[name="entry_price"]').val(),
                    stop_loss: $('[name="stop_loss"]').val(),
                    take_profit: $('[name="take_profit"]').val(),
                    group_type: $('[name="group_type"]').val(),
                    is_open: $('#is-open-switch').is(':checked') ? 1 : 0,
                    entry_price_premium: $('#entry-price-switch').is(':checked') ? 1 : 0,
                    stop_loss_premium: $('#stop-loss-switch').is(':checked') ? 1 : 0,
                    take_profit_premium: $('#take-profit-switch').is(':checked') ? 1 : 0,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                console.log('Form data:', formData);
                // Determine if edit or create
                const isEditMode = $(form).attr('data-mode') === 'edit';
                const signalId = $(form).attr('data-id');
                const url = isEditMode ? `/signals/${signalId}` : '/signals';
                const method = isEditMode ? 'PUT' : 'POST';

                // Show loading indicator
                $('.modal-content').append('<div class="modal-overlay"><div class="spinner-border text-primary"></div></div>');

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,

                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#SignalModal').modal('hide');
                            // Reload DataTable if you're using it
                            if ($.fn.DataTable.isDataTable('#signals-table')) {
                                $('#signals-table').DataTable().ajax.reload(null, false);
                            }
                            resetForm();
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
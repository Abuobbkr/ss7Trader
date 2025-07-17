@foreach($signals as $signal)
    <tr>
        <td class="pe-4 py-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/' . strtolower(str_replace('/', '-', $signal->pair_name)) . '.jpeg') }}"
                            class="me-2" style="width: 30px; height: 30px;" alt="{{ $signal->pair_name }}">
                        <span>{{ strtoupper($signal->pair_name) }}</span>
                    </div>
                </div>
                <div class="col-md-6 text-sm">
                    <small class={{$signal->signal_type=='buy'?'text-success':'text-danger'  }}><b>{{ strtoupper($signal->signal_type) }}</b></small>
                </div>
            </div>

        </td>
        <td class="d-none d-md-table-cell text-success py-4">
            {{ strtoupper($signal->signal_type) }}

        </td>

        <td class="py-4">{{ $signal->entry_price }}</td>
        <td class="py-4">{{ $signal->take_profit }}</td>
        <td class="py-4">{{ $signal->stop_loss }}</td>

        <td class="py-4 ">
            <button class="btn btn-success btn-sm text-light">Trade Now</button>
        </td>

    </tr>
@endforeach
@foreach($signals as $signal)
<tr>
    <td class="py-4">{{ $signal->created_at->format('m/d/Y') }} <span class="ms-1">{{ $signal->created_at->format('g:i:s A') }}</span></td>
    <td class="pe-4 py-4">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/images/' . strtolower(str_replace('/', '-', $signal->pair_name)) . '.jpeg') }}"
                class="me-2" style="width: 30px; height: 30px;" alt="{{ $signal->pair_name }}">
            <span>{{ strtoupper($signal->pair_name) }}</span>
        </div>
    </td>
    <td class="d-none d-md-table-cell text-success py-4">
        {{ strtoupper($signal->signal_type) }}
        @if($signal->take_profit)
            <i class="fas fa-check text-success ms-3"></i>
        @endif
    </td>
    <td class="py-4">
        @if($signal->stop_loss)
            <span class="text-success"><i class="fas fa-check"></i></span>
        @else
            <span class="text-danger fw-bold">X</span>
        @endif
    </td>
    <td class="py-4 {{ $signal->is_open ? 'text-warning' : ($signal->take_profit ? 'text-success' : 'text-danger') }}">
        {{ $signal->is_open ? 'Open' : ($signal->take_profit ? 'Win' : 'Loss') }}
    </td>
    <td class="py-4">{{ $signal->entry_price }}</td>
</tr>
@endforeach

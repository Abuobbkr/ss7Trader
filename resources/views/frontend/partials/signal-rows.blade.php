@foreach($signals as $signal)
    <tr>
        <td data-label="Pair" class="text-nowrap">
            <div class="d-flex align-items-center">
                @if($signal->asset)
                    <img src="{{ asset($signal->asset->image) }}" class="rounded-circle me-2" style="width: 30px; height: 30px;"
                        alt="{{ $signal->asset->pair_name }}">
                    <div class="d-flex flex-column">
                        <span class="fw-bold">{{ strtoupper($signal->asset->pair_name) }}</span>
                        <small class="{{ $signal->signal_type == 'buy' ? 'text-success' : 'text-danger' }} d-md-none">
                            {{ strtoupper($signal->signal_type) }}
                        </small>
                    </div>
                @else
                    <div class="d-flex flex-column">
                        <span class="text-danger">No Asset Found</span>
                        <small class="{{ $signal->signal_type == 'buy' ? 'text-success' : 'text-danger' }} d-md-none">
                            {{ strtoupper($signal->signal_type) }}
                        </small>
                    </div>
                @endif
            </div>
        </td>
        <td class="d-none d-md-table-cell py-4">
            {{-- Check if signal is premium and subscriber is free --}}

            <span
                class="badge {{ $signal->signal_type == 'buy' ? 'bg-success' : 'bg-danger' }}">{{ strtoupper($signal->signal_type) }}</span>
        </td>

        <td class="py-4">

            @if(isset($subscriber_type) && $subscriber_type == 'free' && $signal->entry_price_premium == 1)
                {{-- Show premium badge for free subscribers --}}
                <span class="badge bg-warning">Premium</span>
            @else
                {{ $signal->entry_price }}
            @endif


        </td>
        <td class="py-4">
            @if(isset($subscriber_type) && $subscriber_type == 'free' && $signal->take_profit_premium == 1)
                {{-- Show premium badge for free subscribers --}}
                <span class="badge bg-warning">Premium</span>
            @else
                {{ $signal->take_profit }}
            @endif

        <td class="py-4">

            @if(isset($subscriber_type) && $subscriber_type == 'free' && $signal->stop_loss_premium == 1)
                {{-- Show premium badge for free subscribers --}}
                <span class="badge bg-warning">Premium</span>
            @else
                {{ $signal->stop_loss }}
            @endif



        <td class="py-4">
            <button class="btn btn-success btn-sm text-light">Trade Now</button>
        </td>
    </tr>
@endforeach
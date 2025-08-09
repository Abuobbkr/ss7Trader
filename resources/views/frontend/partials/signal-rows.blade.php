@foreach($signals as $signal)
    <tr>
        <td data-label="Pair" class="text-nowrap">
            <div class="d-flex align-items-center">
                @if($signal->asset)
                    {{-- Assuming the image path is correct, use asset() helper --}}
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
            <span
                class="badge {{ $signal->signal_type == 'buy' ? 'bg-success' : 'bg-danger' }}">{{ strtoupper($signal->signal_type) }}</span>
        </td>

        {{-- Start of new logic for displaying premium content --}}
        {{-- You should use the proper session key for your subscriber status --}}
        @php
            $isSubscriber = session()->has('subscriber_user_id');
        @endphp

        <td class="py-4">
            @if ($isSubscriber)
                {{ $signal->entry_price }}
            @elseif($signal->entry_price_premium == 1)
                <a href="https://www.ss7trader.com/signals" target="_blank" rel="noopener noreferrer">
                    <span class="badge bg-warning">Premium</span>
                </a>
            @else
                {{ $signal->entry_price }}
            @endif
        </td>

        <td class="py-4">
            @if ($isSubscriber)
                {{ $signal->take_profit }}
            @elseif($signal->take_profit_premium == 1)
                <a href="https://www.ss7trader.com/signals" target="_blank" rel="noopener noreferrer">
                    <span class="badge bg-warning">Premium</span>
                </a>
            @else
                {{ $signal->take_profit }}
            @endif
        </td>

        <td class="py-4">
            @if ($isSubscriber)
                {{ $signal->stop_loss }}
            @elseif($signal->stop_loss_premium == 1)
                <a href="https://www.ss7trader.com/signals" target="_blank" rel="noopener noreferrer">
                    <span class="badge bg-warning">Premium</span>
                </a>
            @else
                {{ $signal->stop_loss }}
            @endif
        </td>
        {{-- End of new logic --}}

        <td class="py-4">
            {{-- This check seems to be a bit off, it will show for all free users. --}}
            {{-- You might want to wrap this in an if/else if condition to control visibility --}}
            @if (!$isSubscriber)
                <a href="https://buy.stripe.com/eVq00jaVhfqkgfv41Z8IU00" target="_blank" rel="noopener noreferrer"
                    class="btn btn-success btn-sm text-light">
                    Trade Now
                </a>
            @endif
        </td>
    </tr>
@endforeach
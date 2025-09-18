<div>
    {{-- Search Input --}}
    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search trades...">

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th wire:click="sortBy('entry_date')">
                    Entry Date
                    @if ($sortField === 'entry_date')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th wire:click="sortBy('coin')">
                    COIN
                    @if ($sortField === 'coin')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th>R:R</th>
                <th>Take Profit %</th>
                <th>Stoploss %</th>
                <th>Completed</th>
                <th>Incompleted</th>
                <th wire:click="sortBy('profit_loss')">
                    Profit/loss
                    @if ($sortField === 'profit_loss')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th>Total Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trades as $trade)
                <tr>
                    <td>{{ $trade->entry_date }}</td>
                    <td>{{ $trade->coin }}</td>
                    <td>{{ $trade->rr }}</td>
                    <td>{{ $trade->take_profit_percentage }}%</td>
                    <td>{{ $trade->stoploss_percentage }}%</td>
                    <td>{{ $trade->completed ? 'Yes' : 'No' }}</td>
                    <td>{{ $trade->incompleted ? 'Yes' : 'No' }}</td>
                    <td>{{ number_format($trade->profit_loss, 2) }}</td>
                    <td>{{ number_format($trade->total_balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $trades->links() }}
    </div>
</div>
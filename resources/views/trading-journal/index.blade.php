<div class="card shadow-sm mb-4">
    <div class="card-header bg-white p-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">Trading Journal</h5>
            </div>
            <div class="col-md-6 text-md-end">
                <input type="text" 
                       class="form-control" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search trades by coin...">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th scope="col" wire:click="sortBy('entry_date')">
                            Entry Date
                                <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        </th>
                        <th scope="col" wire:click="sortBy('coin')">
                            COIN
                                <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        </th>
                        <th scope="col">R:R</th>
                        <th scope="col">Take Profit %</th>
                        <th scope="col">Stoploss %</th>
                        <th scope="col">Completed</th>
                        <th scope="col">Incompleted</th>
                        <th scope="col" wire:click="sortBy('profit_loss')">
                            Profit/loss
                                <i class="fa-solid fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        </th>
                        <th scope="col">Total Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($trades->count())
                        @foreach ($trades as $trade)
                            <tr class="align-middle">
                                <td>{{ $trade->entry_date->format('M d, Y') }}</td>
                                <td>{{ $trade->coin }}</td>
                                <td>{{ $trade->rr }}</td>
                                <td>{{ $trade->take_profit_percentage }}%</td>
                                <td>{{ $trade->stoploss_percentage }}%</td>
                                <td>
                                    <span class="badge {{ $trade->completed ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $trade->completed ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $trade->incompleted ? 'bg-danger' : 'bg-secondary' }}">
                                        {{ $trade->incompleted ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="font-weight-bold">
                                    <span class="{{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                        ${{ number_format($trade->profit_loss, 2) }}
                                    </span>
                                </td>
                                <td>${{ number_format($trade->total_balance, 2) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center py-4">No trades found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white pt-3">
        {{ $trades->links() }}
    </div>
</div>

{{-- Font Awesome for sort icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZ8C8jF+65I0h8pG5xG3nK3v5Z8m3fI58d55dE35z3J45l224d084c75d4f3b01859b4c0428d2d88a183d20d7e435985b85a183a152d8e4f1a2384a86e969d51e737c385b2e88c07e86e7a2a5e4b7b282c0384a8e31b1c3e1e619d084d56f4d42b4c1c28c6e28f328f4d1a5c378e9162985f4d1e3d3f9a7d3a2283f58b76c4e859f49b1a5e1d5a7d3a23f58c4e2e217d84f938f4d1e3a1f7d5a7d3a15d788c03e4d94b4c1c28c6e28f328f4d1e3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a7d3a1f7d5a
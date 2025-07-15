<?php

namespace App\Http\Controllers;

use App\Jobs\SendSignalUpdateEmail;
use App\Models\Asset;
use App\Models\Signal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Subscriber; // Assuming you have a Subscriber model
use App\Mail\NewSignalNotification; // Import your Mailable
use App\Mail\SignalUpdateNotification; // Import the new Mailable

use Illuminate\Support\Facades\Mail; // Import the Mail facade

class SignalController extends Controller
{
    public function index()
    {
        $assets = Asset::all();
        return view('pages.signals.index', compact('assets'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $signals = Signal::latest();

            return DataTables::of($signals)
                ->addIndexColumn()
                ->addColumn('serial_number', function ($signal) {
                    return $signal->id;
                })
                ->addColumn('pair_name', function ($signal) {
                    return $signal->pair_name;
                })
                ->addColumn('signal_type', function ($signal) {
                    $badgeClass = $signal->signal_type === 'buy' ? 'bg-success' : 'bg-danger';
                    return '<span class="badge ' . $badgeClass . '">' . $signal->signal_type . '</span>';
                })
                ->addColumn('entry_price', function ($signal) {
                    $badge = $signal->entry_price_premium ? '<span class="badge bg-warning  ms-2 py-0.5 px-1 text-sm">Premium</span>' : '';

                    return number_format($signal->entry_price, 5) . $badge;
                })
                ->addColumn('stop_loss', function ($signal) {
                    $badge = $signal->stop_loss_premium ? '<span class="badge bg-warning  ms-2 py-0.5 px-1 text-sm">Premium</span>' : '';

                    return number_format($signal->stop_loss, 5) . $badge;
                })
                ->addColumn('take_profit', function ($signal) {
                    $badge = $signal->take_profit_premium ? '<span class="badge bg-warning  ms-2 py-0.5 px-1 text-sm">Premium</span>' : '';

                    return number_format($signal->take_profit, 5) . $badge;
                })
                ->addColumn('status', function ($signal) {
                    return $signal->is_open
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Closed</span>';
                })
                ->addColumn('group_type', function ($signal) {
                    $badgeClass = match ($signal->group_type) {
                        'premium' => 'bg-warning',
                        'both' => 'bg-info',
                        default => 'bg-primary',
                    };
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($signal->group_type) . '</span>';
                })
                ->addColumn('market_type', function ($signal) {
                    $badgeClass = match ($signal->market_type) {
                        'forex' => 'bg-warning',
                        'crypto' => 'bg-info',
                        default => 'bg-primary',
                    };
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($signal->market_type) . '</span>';
                })
                ->addColumn('action', function ($signal) {
                    $editBtn = '<button class="btn btn-sm btn-primary edit-signal" data-id="' . $signal->id . '" data-bs-toggle="modal" data-bs-target="#signalModal">Edit</button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger delete-signal" data-id="' . $signal->id . '">Delete</button>';
                    $statusBtn = $signal->is_open
                        ? '<button class="btn btn-sm btn-secondary toggle-status" data-id="' . $signal->id . '">Close</button>'
                        : '<button class="btn btn-sm btn-success toggle-status" data-id="' . $signal->id . '">Reopen</button>';
                    // return $editBtn . ' ' . $deleteBtn . ' ' . $statusBtn;
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['market_type', 'signal_type', 'status', 'group_type', 'action', 'stop_loss', 'entry_price', 'take_profit'])
                ->make(true);
        }

        return view('pages.signals.index'); // Make sure this matches your view path
    }





    public function store(Request $request)
    {
        $validated = $request->validate([
            'pair_name' => 'required|string|max:255',
            'market_type' => 'required|string|in:forex,crypto,stock',
            'entry_price' => 'required|numeric|min:0.00001',
            'stop_loss' => 'required|numeric|min:0.00001',
            'take_profit' => 'required|numeric|min:0.00001',
            'signal_type' => 'required|string|in:buy,sell',
            'group_type' => 'required|string|in:free,premium,both',
            'is_open' => 'boolean', // Existing switch
            'entry_price_premium' => 'boolean',
            'stop_loss_premium' => 'boolean',
            'take_profit_premium' => 'boolean',
        ]);

        try {


            $signal = Signal::create($validated);

            // Fetch all subscribers
            // Assuming your subscribers table has an 'email' column
            $subscribers = Subscriber::all();

            foreach ($subscribers as $subscriber) {
                // Send the email to each subscriber
                // Using Mail::to(). If using queues, this will dispatch to the queue.
                Mail::to($subscriber->email)->send(new NewSignalNotification($signal));
            }

            return response()->json([
                'success' => true,
                'message' => 'Signal created successfully',
                'data' => $signal
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating signal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified signal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signal  $signal
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $signal = Signal::findOrFail($id); // Throws 404 if not found
        $validated = $request->validate([
            'pair_name' => 'required|string|max:255',
            'market_type' => 'required|string|in:forex,crypto,stock', // Corrected 'stocks' to 'stock' if it was a typo
            'entry_price' => 'required|numeric|min:0.00001',
            'stop_loss' => 'required|numeric|min:0.00001',
            'take_profit' => 'required|numeric|min:0.00001',
            'signal_type' => 'required|string|in:buy,sell', // Corrected 'Buy/Long,Sell/Short' to 'buy,sell' to match options
            'group_type' => 'required|string|in:free,premium,both',
            'is_open' => 'boolean', // Existing switch
            // New optional boolean fields for the premium switches
            'entry_price_premium' => 'boolean',
            'stop_loss_premium' => 'boolean',
            'take_profit_premium' => 'boolean',
        ]);

        try {


            $signal->update($validated);

            // Fetch all subscribers to send them the update notification
            // $subscribers = Subscriber::all();

            // foreach ($subscribers as $subscriber) {
            //     // Dispatch the job for each subscriber
            //     SendSignalUpdateEmail::dispatch($signal, $subscriber);
            // }

            return response()->json([
                'success' => true,
                'message' => 'Signal updated successfully',
                'data' => $signal
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating signal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $signal = Signal::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $signal
        ]);
    }
    public function destroy($id)
    {
        try {
            $signal = Signal::findOrFail($id);
            $signal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Signal deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete signal: ' . $e->getMessage()
            ], 500);
        }
    }
}

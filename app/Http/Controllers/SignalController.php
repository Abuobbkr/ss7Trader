<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Signal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
            $signals = Signal::get();

            return DataTables::of($signals)
                ->addIndexColumn()
                ->addColumn('serial_number', function ($signal) {
                    return $signal->id;
                })
                ->addColumn('pair_name', function ($signal) {
                    return $signal->pair_name;
                })
                ->addColumn('signal_type', function ($signal) {
                    $badgeClass = $signal->signal_type === 'Buy/Long' ? 'bg-success' : 'bg-danger';
                    return '<span class="badge ' . $badgeClass . '">' . $signal->signal_type . '</span>';
                })
                ->addColumn('entry_price', function ($signal) {
                    return number_format($signal->entry_price, 5);
                })
                ->addColumn('stop_loss', function ($signal) {
                    return number_format($signal->stop_loss, 5);
                })
                ->addColumn('take_profit', function ($signal) {
                    return number_format($signal->take_profit, 5);
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
                ->addColumn('action', function ($signal) {
                    $editBtn = '<button class="btn btn-sm btn-primary edit-signal" data-id="' . $signal->id . '" data-bs-toggle="modal" data-bs-target="#signalModal">Edit</button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger delete-signal" data-id="' . $signal->id . '">Delete</button>';
                    $statusBtn = $signal->is_open
                        ? '<button class="btn btn-sm btn-secondary toggle-status" data-id="' . $signal->id . '">Close</button>'
                        : '<button class="btn btn-sm btn-success toggle-status" data-id="' . $signal->id . '">Reopen</button>';
                    // return $editBtn . ' ' . $deleteBtn . ' ' . $statusBtn;
                    return $editBtn . ' ' . $deleteBtn ;
                })
                ->rawColumns(['signal_type', 'status', 'group_type', 'action'])
                ->make(true);
        }

        return view('pages.signals.index'); // Make sure this matches your view path
    }

    public function getRolesData(Request $request)
    {
        $isActive = $request->input('is_active', null);

        $roles = Signal::query();

        return DataTables::of($roles)
            ->addIndexColumn()
            ->editColumn('OrderNo', function ($role) {
                return $role->OrderNo;
            })
            ->editColumn('Module', function ($role) {
                return $role->Module;
            })
            ->editColumn('Role', function ($role) {
                return $role->Role;
            })
            ->editColumn('IsActive', function ($role) {

                return $role->IsActive ? '✅' : '❌';
            })
            ->addColumn('Action', function ($role) {
                return '<button class="btn btn-sm btn-edit" data-id="' . $role->RoleID . '">💬️</button>
                    <button class="btn btn-sm btn-delete" data-id="' . $role->RoleID . '">🗑️</button>';
            })
            ->rawColumns(['IsActive', 'Action'])
            ->make(true);
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
            'is_open' => 'boolean'
        ]);

        try {
            $signal = Signal::create($validated);

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

    public function update(Request $request, Signal $signal)
    {
        $validated = $request->validate([
            'pair_name' => 'required|string|max:255',
            'market_type' => 'required|string|in:forex,crypto,stocks',
            'entry_price' => 'required|numeric|min:0.00001',
            'stop_loss' => 'required|numeric|min:0.00001',
            'take_profit' => 'required|numeric|min:0.00001',
            'signal_type' => 'required|string|in:Buy/Long,Sell/Short',
            'group_type' => 'required|string|in:free,premium,both',
            'is_open' => 'boolean'
        ]);

        try {
            $signal->update($validated);

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

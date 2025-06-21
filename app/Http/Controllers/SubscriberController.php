<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\SubscriberCredntialMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
class SubscriberController extends Controller
{
    public function index()
    {
        return view('pages.subscribers.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required',

        ]);

        try {
            $subscriber = Subscriber::create($validated);

            // Send email with raw password
            Mail::to($subscriber->email)->send(new SubscriberCredntialMail($subscriber, '12345'));


            return response()->json([
                'success' => true,
                'message' => 'Subscriber created successfully',
                'data' => $subscriber
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating Subscriber: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $Subscribers = Subscriber::get();

            return DataTables::of($Subscribers)
                ->addIndexColumn()
                ->addColumn('serial_number', function ($Subscriber) {
                    return $Subscriber->id;
                })
                ->addColumn('username', function ($Subscriber) {
                    return $Subscriber->username;
                })
                ->addColumn('email', function ($Subscriber) {
                    return $Subscriber->email;

                    $badgeClass = $Subscriber->Subscriber_type === 'Buy/Long' ? 'bg-success' : 'bg-danger';
                    return '<span class="badge ' . $badgeClass . '">' . $Subscriber->Subscriber_type . '</span>';
                })
                ->addColumn('password', function ($Subscriber) {
                    return $Subscriber->password;

                    return number_format($Subscriber->entry_price, 5);
                })
                ->addColumn('expire_at', function ($Subscriber) {
                    return $Subscriber->expire_at
                        ? $Subscriber->expire_at->format('Y-m-d H:i:s')
                        : 'N/A';

                    return number_format($Subscriber->stop_loss, 5);
                })
                ->addColumn('created_at', function ($Subscriber) {
                    return $Subscriber->created_at
                        ? $Subscriber->created_at->format('Y-m-d H:i:s')
                        : 'N/A';
                    return number_format($Subscriber->take_profit, 5);
                })


                ->addColumn('action', function ($Subscriber) {
                    $editBtn = '<button class="btn btn-sm btn-primary edit-Subscriber" data-id="' . $Subscriber->id . '" data-bs-toggle="modal" data-bs-target="#SubscriberModal">Edit</button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger delete-Subscriber" data-id="' . $Subscriber->id . '">Delete</button>';
                    $statusBtn = $Subscriber->is_open
                        ? '<button class="btn btn-sm btn-secondary toggle-status" data-id="' . $Subscriber->id . '">Close</button>'
                        : '<button class="btn btn-sm btn-success toggle-status" data-id="' . $Subscriber->id . '">Reopen</button>';
                    return $editBtn . ' ' . $deleteBtn . ' ' . $statusBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.Subscribers.index'); // Make sure this matches your view path
    }


    public function edit($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $subscriber
        ]);
    }

    public function update(Request $request, Subscriber $subscriber)
    {

        // dd($request->all());

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required',

        ]);

        // dd($validated);

        try {
            $subscriber = $subscriber->update($validated);
            dd($subscriber);

            return response()->json([
                'success' => true,
                'message' => 'Subscriber updated successfully',
                'data' => $subscriber
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating subscriber: ' . $e->getMessage()
            ], 500);
        }
    }
}

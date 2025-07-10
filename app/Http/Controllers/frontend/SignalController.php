<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Signal;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    public function index()
    {
        $signals = Signal::orderBy("created_at", "desc")->paginate(4); // 10 per page
        // dd("", $signals);
        return view("frontend.index", compact("signals"));
    }

    public function filter(Request $request)
    {
        $query = Signal::query();

        if ($request->has('signal_type') && $request->signal_type != '') {
            $query->where('signal_type', $request->signal_type);
        }

        $signals = $query->latest()->paginate(10); // adjust as needed

        // Return only the table rows
        return response()->json([
            'html' => view('frontend.partials.signal-rows', compact('signals'))->render(),
            'pagination' => $signals->links()->toHtml()
        ]);
    }
}

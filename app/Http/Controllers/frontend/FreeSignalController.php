<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Signal;
use Illuminate\Http\Request;

class FreeSignalController extends Controller
{
    public function index()
    {
        $signals = Signal::orderBy("created_at", "desc")->paginate(5); // 10 per page
        
        return view("frontend.free.index", compact("signals"));
    }

    public function filter(Request $request)
    {
        $query = Signal::query();

        if ($request->has('market_type') && $request->market_type != '') {
            $query->where('market_type', $request->market_type);
        }

        $signals = $query->latest()->paginate(10); // adjust as needed

        // Return only the table rows
        return response()->json([
            'html' => view('frontend.partials.signal-rows', compact('signals'))->render(),
            'pagination' => $signals->links()->toHtml()
        ]);
    }
}

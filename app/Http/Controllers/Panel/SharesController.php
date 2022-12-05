<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Share;

class SharesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('index', Share::class);

        $shares = Share::query();

        //Filters and the rest

        $shares = $shares->orderBy('created_at', 'desc')->paginate(50);

        return view('panel.shares.index', compact('shares'));
    }
}

<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('index', User::class);

        $users = User::query();

        //Filters and the rest

        $users = $users->orderBy('created_at', 'desc')->paginate(20);

        return view('panel.users.index', compact('users'));
    }

    public function promote(User $user)
    {
        $this->authorize('promote', User::class);

        $user->update([
            'role'  => 1
        ]);

        flash('User promoted successfully.')->success();
        return redirect()->back();
    }
}

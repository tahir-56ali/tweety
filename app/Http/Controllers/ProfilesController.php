<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user)
    {
        // block unauthorized access
        /*if ($user->isNot(current_user())) {
            abort(404);
        }*/
        // OR use abort_if helping function to block unauthorized access
        //abort_if($user->isNot(current_user()), 404);

        // OR use policy to block unauthorized access
        //$this->authorize('edit', $user);

        return view('profiles.edit', compact('user'));
    }
}

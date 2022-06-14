<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(50)
        ]);
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

    public function update(User $user)
    {
        $attributes = request()->validate([
           'username' => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)],
           'name' => ['string', 'required', 'max:255'],
           'avatar' => ['file'],
           'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
           'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed'],
        ]);

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        $user->update($attributes);

        return redirect($user->path());
    }
}

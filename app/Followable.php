<?php


namespace App;


trait Followable
{

    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        /*if ($this->following($user)) {
            return $this->unfollow($user);
        }

        return $this->follow($user);*/
        // the one liner short code for above code is by using toggle method on many to many relationship
        $this->follows()->toggle($user);
    }

    public function following(User $user)
    {
        // return $this->follows->contains($user); // bad practice; as it will load all follows collection, let suppose if you follows 3000 people
        return $this->follows()
            ->where('following_user_id', $user->id)
            ->exists();
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }
}

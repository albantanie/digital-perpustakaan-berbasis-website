<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Book $book)
    {
        return $user->isAdmin() || $book->user_id == $user->id;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Book $book)
    {
        return $user->isAdmin() || $book->user_id == $user->id;
    }

    public function delete(User $user, Book $book)
    {
        return $user->isAdmin() || $book->user_id == $user->id;
    }
}

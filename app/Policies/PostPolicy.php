<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->hasPermission('create_posts'); // Kullanıcı 'create_posts' iznine sahip olmalı
    }

    public function update(User $user, Post $post)
    {
        return $user->hasPermission('edit_posts') || $user->id === $post->user_id; // Kullanıcı 'edit_posts' iznine sahip olmalı veya kendi postunu güncelleyebilir
    }

    public function delete(User $user, Post $post)
    {
        return $user->hasPermission('delete_posts') || $user->id === $post->user_id; // Kullanıcı 'delete_posts' iznine sahip olmalı veya kendi postunu silebilir
    }
}

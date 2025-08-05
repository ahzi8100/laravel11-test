<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['phone', 'image'])->paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function comments()
    {
        $user = User::with('comments')->find(18);
        foreach ($user->comments as $comment) {
            echo $comment->comment_text . '<br>' ?? 'belum ada comment';
        }
    }
}

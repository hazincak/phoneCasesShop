<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;


class UserController extends Controller
{
    public function getUser($id)
    {
        return User::findOrFail($id);
    }
}

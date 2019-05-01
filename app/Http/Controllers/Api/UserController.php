<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::paginate(2));
    }
}

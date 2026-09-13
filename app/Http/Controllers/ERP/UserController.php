<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::select(
            'id',
            'name',
            'email',
            'created_at'
        )->get();
    }
}

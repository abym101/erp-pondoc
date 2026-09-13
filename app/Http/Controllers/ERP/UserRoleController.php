<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    public function index()
    {
        return DB::table(
            'model_has_roles'
        )
            ->join(
                'users',
                'users.id',
                '=',
                'model_has_roles.model_id'
            )
            ->join(
                'roles',
                'roles.id',
                '=',
                'model_has_roles.role_id'
            )
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'roles.name as role'
            )
            ->get();
    }
}

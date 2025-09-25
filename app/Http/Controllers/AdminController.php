<?php

namespace App\Http\Controllers;

use App\Contracts\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct(
        protected User $user
    )
    {}
}

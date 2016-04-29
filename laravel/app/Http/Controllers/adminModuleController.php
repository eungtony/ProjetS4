<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Domaine;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminModuleController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth');
        $this->middleware('Admin', ['except' =>['edit', 'store', 'update', 'destroy']]);
    }
}

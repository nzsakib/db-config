<?php

namespace Nzsakib\DbConfig\Http\Controller;

use Illuminate\Routing\Controller;

class ConfigController extends Controller
{
    public function index()
    {
        return view('db-config::index');
    }
}

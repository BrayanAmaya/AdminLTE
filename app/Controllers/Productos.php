<?php

namespace App\Controllers;

class productos extends BaseController
{
    public function index()
    {
        return view('productos/index');
    }
}

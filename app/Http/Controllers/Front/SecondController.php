<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('msg1');
    }

    public function msg0()
    {
        return 'msg 0';
    }

    public function msg1()
    {
        return 'msg 1';
    }

    public function msg2()
    {
        return 'msg 2';
    }

    public function msg3()
    {
        return 'msg 3';
    }
}

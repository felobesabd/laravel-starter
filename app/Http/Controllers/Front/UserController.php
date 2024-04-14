<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function showUserName()
    {
        return 'phelobes 3bd';
    }

    public function getViewFromController()
    {
        $data = [];
        //$data['name']= 'Phelo';
        //$data['age']= '20';

        $obj = new \stdClass();
        $obj->id = 1;
        $obj->name = 'bero';
        $obj->age = 19;

        return view('welcome', compact('data'), compact('obj'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function show(){
        return view('users.show', compact('user'));
    }
    public function update(){}
    public function edit(){}
}

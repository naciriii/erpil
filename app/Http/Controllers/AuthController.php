<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   
   //returns token
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required'
        ]);
        return $this->getAuthToken($request->login,$request->password);
    }

    //
}

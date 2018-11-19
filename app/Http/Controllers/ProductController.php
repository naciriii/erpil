<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{

    //
    public function index()
    {
    	
        $data = $this->send('GET',config('api.products_url'));

        return response()->json($data);
    }
}

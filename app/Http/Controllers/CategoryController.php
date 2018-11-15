<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{

    //
    public function index()
    {
        $data = $this->send('GET',config('api.categories_url'));
    }
}

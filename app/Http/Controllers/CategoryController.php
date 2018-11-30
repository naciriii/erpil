<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

    //
    public function index()
    {
        $data = $this->send('GET',config('api.categories_url'));
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $this->send('POST', config('api.post_category_url'), $request->category);
        return response()->json($data);
    }
}

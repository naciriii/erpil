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

    public function show($id)
    {
        $data = $this->send('GET', str_replace('{id}', $id, config('api.get_category_url')));
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $this->send('POST', config('api.post_category_url'), $request->category);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        $data = $this->send('PUT', str_replace('{id}', $id, config('api.update_category_url')), $request->category);
        return response()->json($data);
    }

    public function delete($id)
    {
        $data = $this->send("DELETE", str_replace('{id}', $id, config('api.delete_category_url')));
        return response()->json($data);
    }
}

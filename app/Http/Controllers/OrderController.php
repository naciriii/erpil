<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class OrderController extends Controller
{

    //
    public function index(Request $request)
    {
        $data = $this->send('GET',
            str_replace(['{page_size}', '{current_page}'],
                [$request->page_size, $request->current_page],
                config('api.orders_url')));
        return response()->json($data);
    }

    public function show($id)
    {
        $data = $this->send('GET', str_replace('{id}', $id, config('api.get_order_url')));
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $this->send('POST', config('api.post_order_url'), $request->order);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        $data = $this->send('PUT', str_replace('{id}', $id, config('api.update_order_url')), $request->order);
        return response()->json($data);
    }

    public function delete($id)
    {
        $data = $this->send("DELETE", str_replace('{id}', $id, config('api.delete_order_url')));
        return response()->json($data);
    }

    public function updateOrderStatus(Request $request)
    {
        $data = $this->send('POST',
                config('api.orders_update_status_url'), $request->entity);
        return response()->json($data);
    }
}

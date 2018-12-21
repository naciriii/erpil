<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $customers = $this->send('GET', str_replace(['{page_size}', '{current_page}'], [$request->page_size, $request->current_page], config('api.customers_url')
        ));
        return response()->json($customers);
    }

    public function show($customerId)
    {
        $data = $this->send('GET', str_replace('{id}', $customerId, config('api.get_customer_url')));
        return response()->json($data);
    }

    public function findBy(Request $request)
    {
        $data = $this->send('GET', str_replace(['{field}', '{value}'], [$request->field, $request->value], config('api.customers_by_filter_url')));
        return response()->json($data);
    }

    public function search (Request $request)
    {
        $data = $this->send('GET', str_replace(
            ['{value}', '{page_size}', '{current_page}'],
            [$request->search, $request->page_size,$request->current_page],
            config('api.customers_search_url')));
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $this->send('POST', config('api.post_customer_url'), $request->customer);
        return response()->json($data);
    }

    public function update($customerId, Request $request)
    {
        $data = $this->send('PUT', str_replace('{id}', $customerId, config('api.update_customer_url')), $request->customer);
        return response()->json($data);
    }

    public function delete($id)
    {
        //dd("DELETE", str_replace('{id}', $id, config('api.delete_customer_url')));
        $data = $this->send("DELETE", str_replace('{id}', $id, config('api.delete_customer_url')));
        return response()->json($data);
    }
}

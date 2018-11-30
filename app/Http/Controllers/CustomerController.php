<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    //
    public function index(Request $request)
    {

        
        $customers = $this->send('GET',str_replace(['{page_size}','{current_page}'], [$request->page_size, $request->current_page], config('api.customers_url')
    ));
        return response()->json($customers);
    }

    public function show($sku)
    {
    	$data = $this->send('GET',str_replace('{sku}',$sku,config('api.get_customer_url')));
    	return response()->json($data);

    }

    public function store(Request $request)
    {

       
        $data = $this->send('POST',config('api.post_customer_url'),$request->customer);

        return response()->json($data);

    }
     public function update($sku, Request $request)
    {
       
        $data = $this->send('PUT',str_replace('{sku}',$sku,config('api.update_customer_url')),$request->customer);

        return response()->json($data);

    }
    public function delete($sku)
    {
        $data = $this->send("DELETE",str_replace('{sku}',$sku,config('api.delete_customer_url')));
        return response()->json($data);

    }

}

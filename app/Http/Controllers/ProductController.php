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
    public function show($sku)
    {
    	$data = $this->send('GET',str_replace('{sku}',$sku,config('api.get_product_url')));
    	return response()->json($data);

    }
}

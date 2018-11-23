<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {

       
        $data = $this->send('POST',config('api.post_product_url'),$request->product);

        return response()->json($data);

    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //
    public function index()
    {
        
        // improvised work around to join stock items with products to get quantities
        // lack of resource because of magento rest api
    	
        $products = $this->send('GET',config('api.products_url'));
        $quantities = $this->send('GET',config('api.get_products_quantities'));
        $quantities = collect($quantities->items);
        foreach ($products->items as $product) {
         $product->qty = $quantities->where('product_id',$product->id)->first()->qty??null;
        }

        return response()->json($products);
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
     public function update($sku, Request $request)
    {
       
        $data = $this->send('PUT',str_replace('{sku}',$sku,config('api.update_product_url')),$request->product);

        return response()->json($data);

    }
    public function delete($sku)
    {
        $data = $this->send("DELETE",str_replace('{sku}',$sku,config('api.delete_product_url')));
        return response()->json($data);

    }

}

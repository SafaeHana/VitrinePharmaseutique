<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
  
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function index_cli(Request $request)

    {
        
    $produits=Product::all()->where('category',"Anti-Covid");
        return view('anti-covid', ['produits'=>$produits]);
    }
    public function index_cli1(Request $request)

    { 
    $produits=Product::all()->where('category',"Medecines");
        return view('anti-covid', ['produits'=>$produits]);
    }
    public function index_cli2(Request $request)

    { 
    $produits=Product::all()->where('category',"Self-Care and Beauty");
        return view('anti-covid', ['produits'=>$produits]);
    }
    public function index_cli3(Request $request)

    { 
    $produits=Product::all()->where('category',"Health and first aids");
        return view('anti-covid', ['produits'=>$produits]);
    }
    public function index_cli4(Request $request)

    { 
    $produits=Product::all()->where('category',"Mum and baby");
        return view('anti-covid', ['produits'=>$produits]);
    }
    public function index_cli5(Request $request)

    { 
    $produits=Product::all()->where('category',"Vitamins");
        return view('anti-covid', ['produits'=>$produits]);
    }
    
    /**
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('products.create',compact('product'));
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
            'file_path' =>'required' // Only allow .jpg, .bmp and .png file types.
        ]);
        
      

        // ensure the request has a file before we attempt anything else.
    
        $request->file_path->store('product', 'public');
        $product = new Product();
        $product->title = $request->get('title');
          $product->price = $request->get('price');
          $product->category = $request->get('category');
          $product->description = $request->get('description');
         // $path = Storage::putFile('public', $request->file_path);
         // $url = Storage::url($path);
          $product->file_path =  $request->file_path->hashName();
      
          $product->save(); // Finally, save the record 
       
   
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',

        ]);
  
        $product->update($request->all());
  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','products deleted successfully');
    }
}

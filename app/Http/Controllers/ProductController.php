<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Http\Requests\storeProduct;
use App\Http\Requests\updateProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cart;
use App\Shipping;
use App\Review;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(2);
        return view('admin.products.index', compact('products'));
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->paginate(3);
        return view('admin.products.index', compact('products'));
    }
    public function recoverpro($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        if($product->restore()){
            return back()->with('message', 'Product successfully restore');
        }else{
            return back()->with('message', 'Error restoring product');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeProduct $request)
    {
        $extension = ".".$request->thumbnail->getClientOriginalExtension();
        $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
        $name = $name.$extension;
        $path = $request->thumbnail->storeAs('images', $name, 'public');
        $product = Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->discription,
            'thumbnail' => $path,
            'status' => $request->status,
            'featured' => $request->featured ? $request->featured : 0,
            'price' => $request->price,
            'discount' => $request->discount ? $request->discount : 0,
            'discount_price' => $request->discount ? $request->discount : 0,

        ]);
        if($product){
            $product->categories()->attach($request->category_id);
            return back()->with('message', 'Product successfully added');
        }else{
            return back()->with('message', 'Error Inserting product');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       
       $vegCategory = Category::where('title', '=', 'vegetable')->get();
       $fruitCategory = Category::where('title', '=', 'fruit')->get();
       $allProducts = Product::all();
       return view('welcome', compact('allProducts', 'vegCategory', 'fruitCategory'));
    }
    public function productDetail($slug){
       $product = Product::where('slug', '=', $slug)->get();
       $productJson = json_decode(json_encode($product));
       // get reviews and ratings
       $reviews = Review::where('product_id', '=', $productJson[0]->id)->get();
       // get categories ids related to product
       $cat_id = "";
       foreach($product as $pro)
       {
          foreach($pro->categories as $cat)
          {
              $cat_id = $cat->id;
          }
       }
       // get category by using $cat_id 
       $category = Category::where('id', '=', $cat_id)->get();
       return view('detail', compact('product', 'category', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(updateProduct $request, Product $product)
    {
        
          if($request->has('thumbnail'))
          {
              $extension = ".".$request->thumbnail->getClientOriginalExtension();
              $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
              $name = $name.$extension;
              $path = $request->thumbnail->storeAs('images', $name, 'public');
              $product->thumbnail = $path;
          }

             $product->title = $request->title;
             $product->slug = $request->slug;
             $product->description = $request->discription;
             $product->status = $request->status;
             $product->featured = $request->featured ? $request->featured : 0;
             $product->price = $request->price;
             $product->discount = $request->discount ? $request->discount : 0;
             $product->discount_price = $request->discount ? $request->discount : 0;
             $product->categories()->detach();
             $product->categories()->attach($request->category_id);

             if($product->save()){
                 return back()->with('message', 'Product updated successfully ');
             }else{
                 return back()->with('error', 'Error updating product');
             }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
       $product = Product::onlyTrashed()->find($id);
       if($product->categories()->detach() && $product->forceDelete()){
           return response()->json(['status' => 'Product deleted successfully']);
       }else{
           return response()->json(['status' => 'Error deleting product']);
       }
    }
    public function remove(Product $product)
    {
        if($product->delete()){
            return back()->with('message', 'Product removed successfully');
        }else{
            return back()->with('error', 'Error removing product');
        }
    }

    /*
      * Add cart for adding items into the cart
    
    */
    public function showCart(){
        if(!Session::has('cart') || !(Session::get('cart')->getTotalQty() > 0))
        {
           
             return back();
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('cart', compact('cart'));
        
    }
    public function addCart(Request $request, $id){
       
       $product = Product::find($id);
       $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $qty = $request->qty ? $request->qty : 1;
       $cart = new Cart($oldCart);
       $cart->addProduct($product, $qty);
        Session::put('cart', $cart);
        return back()->with('message', 'product add to cart successfully');
       
    }
    public function removeCart(Product $product){
        if(!Session::has('cart') || !(Session::get('cart')->getTotalQty() > 0))
        {
            return back();
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeProduct($product);
        Session::put('cart', $cart);
        return back()->with('message', "Product $product->title has been removed from the cart");
    }
    public function shippingAddress(){
        if(!Session::has('cart') || !(Session::get('cart')->getTotalQty() > 0))
        {
            return back();
        }
        $oldCart = Session::get('cart');
        $authId = Auth::id();
        $ship_add = Shipping::where('user_id', '=', $authId)->get();
        $cart = new Cart($oldCart);
        return view('shipping', compact('cart', 'ship_add'));
    }
    public function shippingAddressSave(Request $request){
         $request->validate([
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "contact" => "required|regex:/^[0-9]{10}$/",
            "email" => "required|email",
            "country" => "required|max:255",
            "state" => "required|max:255",
            "city" => "required|max:255",
            "address" => "required|max:255"
         ]);
         // Get Authenticate user id
         $id = Auth::id();
         // store shipping credential
        $shipping = Shipping::create([
             "user_id" => $id,
             "first_name" => $request->first_name,
             "last_name" => $request->last_name,
             "phone" => $request->contact,
             "email" => $request->email,
             "country" => $request->country,
             "state"   => $request->state,
             "city"    => $request->city,
             "address" => $request->address
         ]);
         if($shipping)
         {
             //get shipping address
             $ship_address = Shipping::where('user_id', '=', $id)->get();
             return back();
         }

    }
    //
}

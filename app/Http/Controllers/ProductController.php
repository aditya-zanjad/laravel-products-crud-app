<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class ProductController extends Controller
{
    /**
     * Path for storing the product images
     * 
     * @var string $productImageStorePath
     */
    private string $productImageStorePath = "public/products_images";

    /**
     * 
     * Apply middleware so that only authenticated users 
     * can access methods of this class
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadCrumbItems = [
            'Home' => '/',
            'View Products' => false
        ];

        $products = Product::all();

        return view('products.index')
            ->with('products', $products)
            ->with('breadCrumbItems', $breadCrumbItems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadCrumbItems = [
            'Home' => '/',
            'Add Product' => false
        ];

        return view('products.create')->with('breadCrumbItems', $breadCrumbItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaveProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProductRequest $request)
    {   
        // Get name of the file with its extension
        $fileNameWithExtension = $request->file('product-image')->getClientOriginalName();

        // Get extension of the file
        $fileExtension = $request->file('product-image')->getClientOriginalExtension();

        // If not a valid image type
        $errors = new MessageBag();
        if (!in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
            $errors->add('product-image', 'This is not a valid image. Valid image types are: jpg, jpeg, png');
            return redirect()->route('products.create')->withErrors($errors);
        }

        // Get only the name of the file without its extension
        $onlyFileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        
        // Create a new file name than will be stored in the database
        $fileNameToStore = $onlyFileName . '-' . time() . '.' . $fileExtension;

        // Prepare data for storing it into the database
        $product = [
            'product_name' => $request->input('product-name'),
            'product_description' => $request->input('product-description'),
            'product_price' => $request->input('product-price'),
            'product_image' => $fileNameToStore
        ];

        // Store the data
        $storeResult = Product::create($product);

        if ($storeResult) {
             // Store the file locally
            $path = $request->file('product-image')->storeAs($this->productImageStorePath, $fileNameToStore);
            Session::flash('success', 'The product was stored successfully');
            return redirect()->route('products.create');
        }

        Session::flash('failed', 'Failed to store the product into the database');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        $breadCrumbItems = [
            'Home' => '/',
            'Show Product' => false,
            $product->product_name => false
        ];

        return view('products.show')
            ->with('product', $product)
            ->with('breadCrumbItems', $breadCrumbItems);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        $breadCrumbItems = [
            'Home' => '/',
            'Edit Product' => false,
            $product->name => false
        ];

        return view('products.edit')
            ->with('product', $product)
            ->with('breadCrumbItems', $breadCrumbItems);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        // Find the product from the database
        $existingProduct = Product::find($id);

        $updatedData = [];

        // Update product with new data
        if ($existingProduct) {
            $updatedData = [
                'product_name' => $request->input('product-name'),
                'product_description' => $request->input('product-description'),
                'product_price' => $request->input('product-price')
            ];
        }

        $fileNameToStore = '';

        if ($request->hasFile('product-image')) {
            // Get name of the file with its extension
            $fileNameWithExtension = $request->file('product-image')->getClientOriginalName();

            // Get extension of the file
            $fileExtension = $request->file('product-image')->getClientOriginalExtension();

            // Create custom validation errors, since for some reason mimes type validation is not working
            $errors = new MessageBag();

            if (!in_array($fileExtension, [ 'jpg', 'jpeg', 'png' ])) {
                $errors->add('product-image', 'This is not a valid image. Valid image types are: jpg, jpeg, png');
                return redirect()->route('products.edit', $existingProduct->id)->withErrors($errors);
            }

            // Get only the name of the file without its extension
            $onlyFileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            
            // Create a new file name than will be stored in the database
            $fileNameToStore = $onlyFileName . '-' . time() . '.' . $fileExtension;

            // Store the file locally
            $path = $request->file('product-image')->storeAs($this->productImageStorePath, $fileNameToStore);
            $updatedData['product_image'] = $fileNameToStore;
        }

        // Reflect new changes in the database
        $updateResult = Product::where('id', $existingProduct->id)->update($updatedData);

        // If update successful, display the success message
        if ($updateResult) {
            if ($request->hasFile('product-image')) {
                // Delete the previous image of the product
                Storage::delete($this->productImageStorePath . '/' . $existingProduct->product_image);
            }
            Session::flash('success', 'The product was successfully updated');
            return redirect()->route('products.index');
        }

        Session::flash('failed', 'Failed to update the product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteResult = Product::destroy($id);

        if ($deleteResult) {
            Session::flash('The product was deleted successfully');
            return redirect()->route('products.index');
        }

        Session::flash('Failed to delete the product');
    }
}

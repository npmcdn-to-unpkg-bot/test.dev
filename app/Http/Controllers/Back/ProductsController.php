<?php

namespace App\Http\Controllers\Back;

use App\Material;
use App\Product;
use App\Season;
use App\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCreate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function  __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $products=Product::all()->toArray();

        return response()->json($products,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $seasons=Season::all();
        $categories=Category::get()->toTree();
        $materials=Material::all();
        return view('back.products.create',compact('seasons','categories','materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreate $request)
    {

        $validator=\Validator::make($request->all(),$request->rules());
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        else {
            $product = Product::create($request->all());


            $product->seasons()->attach($request->get('season'));
            $product->materials()->attach($request->get('material'));
            $product->categories()->attach($request->get('category'));

            \Event::fire(new \App\Events\ProductCreate($product));

            return response()->json(['message' => 'Модель ' . $product->model . ' добавлена в каталог...'], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

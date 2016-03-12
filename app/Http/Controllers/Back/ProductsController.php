<?php

namespace App\Http\Controllers\Back;

use App\Events\ProductDelete;
use App\Material;
use App\Product;
use App\Season;
use App\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCreate;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

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
        $product=Product::find($id);

        $seasons=Season::pluck('slug','id')->toArray();
        $materials=Material::pluck('name_ru','id');
        $categories=Category::get()->linknodes()->pluck('name_ru','id');
        return response()->view('back.products.edit',compact('product','seasons','materials','categories'));
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
      $product=Product::find($id);
        if($product){

            try {
                $product->update($request->all());
                $product->seasons()->sync($request->get('season_list'));
                $product->materials()->sync($request->get('material_list'));
                return response()->json(['message' => 'Обновлено!'], 200);
            }catch (\Exception $ex){
                \Log::error($ex->getFile().' '.$ex->getLine().' '.$ex->getMessage());
            }
        }
        else{
            abort(404,"Запрашиваемый ресурс не найден!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        $product=Product::find($id);
        if($product!==null) {

            \Event::fire(new ProductDelete($product));

            $product->delete();
        }
        return response()->json(['message'=>'Запись удалена'],200);

    }


    /**
     * if current instance of product has no publicated,
     * then set publisehd to 1, otherwise to 0
     *
     * @param $id - product id
     * @return instanceof Product model
     */
    public function publish($id){

        $product=Product::find($id);
        $product->published?$product->published=0:$product->published=1;

        $product->save();
        return response()->json($product);

    }

    public function files(Product $product){

        return response()->view('back.products.upload',compact('product'));

    }


    private function listImages(Product $product){
        return \Storage::disk('uploads')->files($product->model);
    }
}

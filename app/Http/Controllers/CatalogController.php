<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\FilterRequest;
use App\Product;
use App\Season;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class CatalogController extends Controller
{

    private $onpage=12;

    public function __construct(Request $request){

        array_key_exists('on',$request->query())?$this->onpage=$request->query('on'):$this->onpage;

    }

    public function index(Request $request)
    {
        if($request->ajax()) {

            $products=$this->ajaxSearch($request->query(),null)->get();

            return response()->json([
                'url'=>preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D',http_build_query($request->query())),
                'count'=>$products->count()
            ]);
        }
        else{
            if (!empty($request->query())) {

                $products = $this->filtrate($request->query());
            } else {
                $products = Product::published()
                    ->orderBy('created_at', 'desc')
                    ->paginate($this->onpage);
            }

            $category = null;
            return response()->view('front.catalog.list', compact('products', 'category'));

        }
    }


    public function category(Request $request,Category $category)
    {

        if ($category == null) {
            abort(404);
        }
        else {

            if($request->ajax()){

                $products=$this->ajaxSearch($request->query(),$category)->get();

                return response()->json([
                    'url'=>preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D',http_build_query($request->query())),
                    'count'=>$products->count()
                ]);
            }
            else {

                if (!empty($request->query())) {
                    $products = $this->filtrate($request->query(), $category);
                }
                else {
                    $products = Product::ByCategory($category)->orderBy('created_at', 'desc')->published()->paginate($this->onpage);
                }

                return response()->view('front.catalog.list', compact('products', 'category'));
            }
        }

    }


    public function item($id){


        $product=Product::findOrFail($id);


        return response()->view('front.partials.item',compact('product'));

    }


    /** Фильтрация записей в каталоге
     * @param array $params
     * @param Category|null $category
     * @return mixed
     */
    private function filtrate(array $params,Category $category=null){

        $products=is_null($category)?Product::query():Product::query()->ByCategory($category);

        if(array_key_exists('new',$params))
            $products=$products->new();
        if(array_key_exists('season',$params))

            $products=$products->bySeason($params['season']);
        if(array_key_exists('sort',$params)) {
            $products = $products->orderBy($params['sort'], $params['order']);
        }
        else {
            $products = $products->orderBy('created_at', 'desc');
        }

        $products=$products->published()->paginate($this->onpage);

        return $products;
    }


    /** Ajax поиск по каталогу
     * @param array $params
     * @return Builder
     */
    private function ajaxSearch(array $params,Category $category=null){

        is_null($category)?$products=Product::query():$products=Product::query()->byCategory($category);

        if(array_key_exists('season',$params)){
            $products=$products->bySeason($params['season']);
        }
        if(array_key_exists('new',$params)){
            $products=$products->new();
        }

        return $products;
    }

}
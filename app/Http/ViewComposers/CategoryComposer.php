<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 25.01.2016
 * Time: 11:56
 */

namespace App\Http\ViewComposers;

use App\Category;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\View\View;

class CategoryComposer
{


    protected $category;


    public function __construct(Category $category){

        $this->category=$category;

    }


    public function compose(View $view){

        $catTree=null;

       /* if(\Cache::has('tree')) {
            $catTree = \Cache::get('tree');
        }
        else {
            \Cache::put('tree', $this->category->get()->toTree(), Carbon::now()->addDay());
            $catTree = \Cache::get('tree');

        }*/

        $catTree=$this->category->get()->toTree();

        $view->with('categories',Helper::treeToArray($catTree));

    }


}
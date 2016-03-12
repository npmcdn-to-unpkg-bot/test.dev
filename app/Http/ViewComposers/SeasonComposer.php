<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 03.02.2016
 * Time: 11:40
 */

namespace App\Http\ViewComposers;


use App\Season;
use Illuminate\View\View;

class SeasonComposer
{

    protected $season;


    public function __construct(Season $season){

        $this->season=$season;

    }


    public function compose(View $view){

        $view->with('seasons',$this->season->all());

    }


}
<?php

namespace App\Listeners;

use App\Events\ProductCreate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductCreateConfirm
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreate  $event
     * @return void
     */
    public function handle(ProductCreate $event)
    {

        if(!\Storage::disk('catalog')->exists($event->product->model))
            try {
                \Storage::disk('catalog')->makeDirectory($event->product->model);
                \Storage::disk('catalog')->makeDirectory($event->product->model . '/small');
            }catch(\Exception $ex){
                \Log::error($ex->getFile().' - '.$ex->getMessage());
            }

    }
}

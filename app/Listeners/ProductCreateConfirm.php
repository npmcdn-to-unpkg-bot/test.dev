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

        if(!\Storage::disk('uploads')->exists($event->product->model))
            try {
                \Storage::disk('uploads')->makeDirectory($event->product->model);
            }catch(\Exception $ex){
                \Log::error($ex->getFile().' - '.$ex->getMessage());
            }

    }
}

<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Upload;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @return void
     */
    public function created(Product $product)
    {
        Upload::where('temporary_id', request('uuid'))->update([
            'uploadable_id' => $product->id,
            'uploadable_type' => Product::class,
            'temporary_id' => null,
        ]);
    }

    /**
     * Handle the Product "updated" event.
     *
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}

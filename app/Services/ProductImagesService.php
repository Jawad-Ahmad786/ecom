<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductImagesService
{
    public function storeImages($product, $images, $update=false)
    {
        if($update){

               $this->deleteImages($product);
        }

      try {
          foreach ($images as $image) {
              $path = $image->store('products');
              $product->images()->create([
                  'image' => $path
              ]);
          }
          return true;
      } catch(\Exception $e){
           return "An error occured while uploading images.";
      }
    }
    public function deleteImages($product)
    {
        foreach($product->images as $image)
        {
          if(Storage::exists($image->image)){
              Storage::delete($image->image);
          }
               $image->delete();
        }
    }
}
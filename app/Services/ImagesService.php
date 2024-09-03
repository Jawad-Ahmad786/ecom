<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImagesService
{
    public function storeImages(Product $product, array $images): bool|string
    {
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
    public function deleteImages(object $model, array $images= []): bool
    {
       try{
           foreach($model->images as $image)
           {
             if(!empty($images)){
                if(in_array($image->id, $images))
                 if(Storage::exists($image->image)){
                     Storage::delete($image->image);
                 }
                 $image->delete();
             }
              else{
                  if(Storage::exists($image->image)){
                      Storage::delete($image->image);
                  }
                  $image->delete();
              }
           }
              return true;
       } catch(\Exception $e){
               return false;
       }
    }
}
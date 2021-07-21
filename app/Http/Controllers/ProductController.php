<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  
        public function created(Request $request){

         
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'quntity' => 'required',
                'category_id' => 'required',
              
                
            ]);
            $today = date("H:i:s");  
            $today = $today . date("Ymd") ;

            $url1 = Storage::url("images/" . $today  . $request->image1->getClientOriginalName());
            $url2 = Storage::url("images/" .$today. $request->image2->getClientOriginalName() );
            $url3 = Storage::url("images/" .$today . $request->image3->getClientOriginalName());

            $product = new Product([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quntity' => $request->quntity,
                'category_id' => $request->category_id,
                'Smallcategory_id' => $request->Smallcategory_id,
                'image1' => $request->getSchemeAndHttpHost() . $url1,
                'image2' => $request->getSchemeAndHttpHost() . $url2,
                'image3' => $request->getSchemeAndHttpHost() . $url3 
            ]);
            $request->image1->storeAs('/public/images', $today . $request->image1->getClientOriginalName()  ); 
            $request->image2->storeAs('/public/images',$today .  $request->image2->getClientOriginalName()  ); 
            $request->image3->storeAs('/public/images', $today . $request->image3->getClientOriginalName()  ); 


            return $product->save();

        }

        public function delete(Request $request){
            
            $request->validate([
                'id' => 'required'
            ]);

            Product::where('id', $request->id)
                            ->delete();
            return Storage::delete([$request->image1, $request->image2, $request->image3]);
        }

        public function update(Request $request){
            $request->validate([
                'id'=> 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'quntity' => 'required',
             
                
            ]);

            return Product::where('id', $request->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quntity' => $request->quntity,

            ]);

        }

        public function getAll(){
            return Product::get();
        }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SmallCategory;
class CategoryController extends Controller
{
  public function Created(Request $request)
  {
      $request->validate([
          'categoryname'=> 'required|string', 
      ]);

      $category = new Category(['categoryname' =>
      $request->categoryname]);

        $category->save();
        return response ([
        'data' => $category]);
  }

  public function getAll(){
    
    return Category::get();
  }

  public function getAllWithSmallCategory(){

    
    return Category::with('smallCategory')
                        ->get();
  }


  public function delete(Request $request){
      $request->validate([
        'id' => 'required',
       
      ]);

      return Category::where('id', $request->id)
                        ->delete();
  }

  public function update(Request $request){
    $request->validate([
      'id' => 'required',
      'categoryname' => 'required|string'
    ]);
    return Category::where('id', $request->id)
                      ->update(['categoryname'=>$request->categoryname]);
  }
}

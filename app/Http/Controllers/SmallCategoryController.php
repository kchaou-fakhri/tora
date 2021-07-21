<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmallCategory;

class SmallCategoryController extends Controller
{
    public function Created(Request $request)
    {
        $request->validate([
            'name'=> 'required|string', 
            'category_id'=> 'required'
        ]);
  
        $small = new SmallCategory(['name' =>
        $request->name,
        'category_id'=>$request->category_id]);
  
          $small->save();
          return response ([
          'data' => $small]);
    }

    public function delete(Request $request){
        $request->validate([
          'id' => 'required',
         
        ]);
  
        return SmallCategory::where('id', $request->id)
                          ->delete();
    }

    public function update(Request $request){
        $request->validate([
          'id' => 'required',
          'name' => 'required|string'
        ]);
        return SmallCategory::where('id', $request->id)
                          ->update(['name'=>$request->name]);
      }

    public function findById($id){
      
      return SmallCategory::where('category_id', $id)
                              ->get();
    }
}


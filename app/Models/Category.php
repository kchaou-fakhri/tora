<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'id','categoryname', 'category_id'
    ];

    public function smallCategory()
    {
      return $this->hasMany(SmallCategory::class);
    }
}

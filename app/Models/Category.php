<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'parent_id', 'category_img', 'category_state'];
    public  function mainCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function scopeDefaultCategory($query)
    {
        return  $query;
    }
    public function getActive($active)
    {
        return $active != 1 ? 'مفعل' : 'غير مفعل';
    }





    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }
}
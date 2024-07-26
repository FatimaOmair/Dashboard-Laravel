<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'parent_id', 'image', 'status', 'slug'
    ];

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
                new Filter(['laravel']),
            ],
            'parent_id' => [
                'int',
                'nullable',
                'exists:categories,id'
            ],
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576|dimensions:min_width=100,min_height=100',
        ];
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id')->withDefault([
            'name' => 'Main Category'
        ]);
    }


    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }


    protected function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
    }

    protected function scopeStatus(Builder $builder, $status)
    {
        return $builder->where('status', '=', $status);
    }

    protected function scopeFilter(Builder $builder, $filter)
    {
        if (isset($filter['name']) && $filter['name']) {
            $builder->where('categories.name', 'LIKE', "%" . $filter['name'] . "%");
        }

        if (isset($filter['status']) && $filter['status']) {
            $builder->where('categories.status', '=', $filter['status']);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image'];

    public static function rules($id = 0)
    {
        return [
            'title' => "required|string|max:255",
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576|dimensions:min_width=100,min_height=100',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    protected $fillable = [
        'page', 'section', 'slug', 'title', 'description', 'sub_title', 'sub_description', 'image', 'btn_text', 'btn_url', 'metadata', 'status',
    ];
}

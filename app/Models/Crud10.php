<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud10 extends Model
{
    use HasFactory;

    protected $fillable = [
        'crud7_id',
        'crud8_id',
        'crud9_id',
        'post_serial',
        'post_name',
        'post_title',
        'short_description',
        'post',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Crud7::class, 'crud7_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Crud8::class, 'crud8_id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(Crud9::class, 'crud9_id');
    }
}

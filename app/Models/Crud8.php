<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crud8 extends Model
{
    use HasFactory;

    protected $fillable = [
        'crud7_id',
        'name',
        // 'slug',
        'serial_no',
        'status',
    ];

    // Auto Slug Generation 
    public static function boot()
    {
        parent::boot();

        static::creating(function ($subcategory) {
            $subcategory->slug = Str::slug($subcategory->name);
        });

        static::updating(function ($subcategory) {
            $subcategory->slug = Str::slug($subcategory->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Crud7::class, 'crud7_id');
    }
}

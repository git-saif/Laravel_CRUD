<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crud9 extends Model
{
    use HasFactory;

    protected $fillable = [
        'crud8_id',
        'name',
        // 'slug',
        'serial_no',
        'status',
    ];

    // Auto slug generation
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    // relation -> parent Subcategory (Crud8)
    public function subcategory()
    {
        return $this->belongsTo(Crud8::class, 'crud8_id');
    }
}

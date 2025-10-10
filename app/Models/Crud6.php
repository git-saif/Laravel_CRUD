<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud6 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'status',
    ];

    // Image field accessor (always return array)
    public function getImageAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
}

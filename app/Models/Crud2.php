<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud2 extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Accessor for image field
    public function getImageAttribute($value)
    {
        return json_decode($value, true); // Always return array
    }
}

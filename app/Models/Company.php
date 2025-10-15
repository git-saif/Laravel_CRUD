<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_tagline',
        'company_email',
        'company_phone',
        'company_address',
        'company_favicon',
        'company_logo',
        'company_booking_link',
        'company_whatsapp_link',
        'company_facebook_link',
        'company_instagram_link',
        'company_twitter_link',
        'company_youtube_link',
        'company_linkedin_link',
        'company_google_map_link',
        'status',
    ];
}

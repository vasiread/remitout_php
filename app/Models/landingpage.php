<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landingpage extends Model
{

    use HasFactory;
    protected $table = 'landingpage';

    protected $fillable = ['banner_header', 'banner_little_quote', 'banner_little_description', 'button_textcontent', 'video_trigger_button'];

}

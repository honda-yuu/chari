<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'body',
        'user_id',
        'facility_id',
        'name',
        'star_number',
        
        ];
}

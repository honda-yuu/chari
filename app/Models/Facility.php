<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;

class Facility extends Model
{
    use HasFactory;
    
     //Regionテーブルとのリレーション//
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    public function getPaginateByLimit(int $limit_count = 20)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
    return $this::with('region')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
   
}

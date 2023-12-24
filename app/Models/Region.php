<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    
    /*regionsテーブルから::pluckでareaとidを抽出し、$categoriesに返す関数を作る*/
    public function getlists()
    {
        $regions = Regions::pluck('area' , 'id');
        
        return $regions;
    }
    
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
    
    public function getByRegion(int $limit_count = 5)
    {
     return $this->facilities()->with('region')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}

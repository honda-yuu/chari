<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Contact;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class BikeController extends Controller
{
    /*トップページの表示*/
    
    public function index(Facility $facility)
    {
        return view('/park/index')->with(['facilities' => $facility->getPaginateByLimit()]);
    }
    
    /*詳細表示*/
    
    public function show(Facility $facility)
    {
        return view('/park/show')->with(['facility' => $facility]);
        
    }
    
    
    /*問い合わせフォーム*/
    
    public function contact()
    {
        return view('/park/contact');
    }
    
    /*問い合わせフォーム保存*/
    
    public function store(ContactRequest $request ,Contact $contact)
    {
       $input = $request['contact'];
       $input['user_id'] = Auth::id();
       $contact->fill($input)->save();
       return redirect('/park/');
    }
    
  
   
    /*検索機能*/
    
     public function facilitysearch(Request $request, Facility $facility)
    {   
         
        
        $keyword = $request->input('keyword');
        $query = Facility::query();
         if(!empty($keyword))
         {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }
        $search_region=$request->input("regionId");
        if(!empty($search_region))
         {
            $query->where('region_id',$search_region);
        }
        $regions=Region::get();
        $facilities = $query->get();
        //dd($regions);
        return view('/park/facilitysearch')->with(['keyword'=> $keyword, 'facilities' => $facilities, 'regions' => $regions]);
    
       
        
    }
    
    /*口コミ機能*/
     public function review(Facility $facility)
     {   
         return view('/park/review')->with(['facility' =>$facility]);
     }
     
     /*口コミ保存*/
     public function reviewstore(Request $request, Review $review)
     { 
         $input = $request['review'];
         $input['user_id'] = Auth::id();
         $review->fill($input)->save();
         return redirect('/park/'.$review->facility_id);
     }
     
     public function selectform()
     {
         return redirect('/park/');
     }
   
}

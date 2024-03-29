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
use Illuminate\Support\Js;
use Cloudinary; 

class BikeController extends Controller
{
    /*トップページの表示*/
    
    public function index(Facility $facility)
    {
        return view('/park/index')->with(['facilities' => $facility->getPaginateByLimit()]);
    }
    
    /*詳細表示*/
    
    public function show(Facility $facility, Review $review , Request $request)
    {   
        $review = Review::where('facility_id', $facility->id)->latest()->get();
       // $image1 = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        //dd($image1);
        return view('/park/show')->with(['facility' => $facility , 'reviews' => $review]);
        
        
    }
    
    
    /*問い合わせフォーム*/
    
    public function contact(Facility $facility)
    {
        return view('/park/contact')->with(['facility' => $facility]);
    }
    
    /*問い合わせフォーム保存*/
    
    public function store(ContactRequest $request ,Contact $contact , User $user)
    {  //$input['facility_id'] =$facility->id;
       
       $input = $request['contact'];
       $user_id= Auth::id();
       $input['user_id'] = $user_id;
       $contact->user_id = $input["user_id"];
       $contact->name = $input["name"];
       $contact->body = $input["body"];
       $contact->save();
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
         //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
         if($request->file('image')){
         
         $image = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
         $input += ['image' => $image];
         }
         $input['user_id'] = Auth::id();
         $review->fill($input)->save();
         return redirect('/park/'.$review->facility_id);
     }
     
     public function selectform()
     {
         return redirect('/park/');
     }
     
}     
      

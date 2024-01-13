<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Facility;
use App\Models\User;
use App\Models\Region;
use App\Http\Requests\ContactRequest;
use App\Models\Review;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function answer(Contact $contact)
    {
       return view('admin.answer')->with(['contacts' => $contact->get()]);
    }
    
    /*public function answerStore()
    {
        
    }*/
    
    public function index(Facility $facility)
    {
        return view('/admin/index')->with(['facilities' => $facility->getPaginateByLimit()]);
    }
    
     public function show(Facility $facility, Review $review , Request $request)
    {   
        $review = Review::where('facility_id', $facility->id)->latest()->get();
       // $image1 = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        //dd($image1);
        return view('/admin/show')->with(['facility' => $facility , 'reviews' => $review]);
        
        
    }
    
     public function contact(Facility $facility)
    {
        return view('/admin/contact')->with(['facility' => $facility]);
    }
    
    public function store(ContactRequest $request ,Contact $contact , User $user)
    {  
       
       $input = $request['contact'];
       $user_id= Auth::id();
       $input['user_id'] = $user_id;
       $contact->user_id = $input["user_id"];
       $contact->name = $input["name"];
       $contact->body = $input["body"];
       $contact->save();
       return redirect('/admin/index');
    }
   
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
        return view('/admin/facilitysearch')->with(['keyword'=> $keyword, 'facilities' => $facilities, 'regions' => $regions]);
    
    }
    
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
         return redirect('/admin/park/'.$review->facility_id);
     }
     
     public function selectform()
     {
         return redirect('/admin/park/');
     }

}

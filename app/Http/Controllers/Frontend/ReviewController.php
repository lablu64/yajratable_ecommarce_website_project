<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
       $check = DB::table('reviews')->where('user_id',Auth::id())->where('product_id',$request->product_id)->first();
        if($check){
            $notification=array('messege' => 'Already Review exit', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
       $data = array(
            'user_id' => Auth::id(),
            'product_id' =>$request->product_id,
            'review' => $request->review,
            'rating' => $request->rating,
            'review_date' => date('d-m-Y'),
            'review_month'=>date('F'),
            'review_year' =>date('Y'),
        );
  
       DB::table('reviews')->insert($data);
       $notification=array('messege' => 'Thanks for your Review !', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }

    //
    public function writereview(){
        return view('frontend.user.review_write');
    }

    public function storewebsitereview(Request $request){
        $check=DB::table('wbreviews')->where('user_id',Auth::id())->first();
        if ($check) {
           $notification=array('messege' => 'Review already exist !', 'alert-type' => 'success');
           return redirect()->back()->with($notification);
        }

        $data=array();
        $data['user_id']=Auth::id();
        $data['name']=$request->name;
        $data['review']=$request->review;
        $data['rating']=$request->rating;
        $data['review_date']=date('d , F Y');
        $data['status']=0;
        DB::table('wbreviews')->insert($data);
        $notification=array('messege' => 'Thank for your review !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }
}

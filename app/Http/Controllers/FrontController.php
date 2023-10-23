<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Categories;
use App\Models\Courses;
use App\Models\Achievement;
use App\Models\Team;
use App\Models\Faq;
use App\Models\User;
use App\Models\Order;


use App\Models\Message;
use App\Models\ReceiverEmail;
use App\Mail\ContactUs;
use App\Models\QrCode;
use Mail;
use Carbon\Carbon;
use LaravelLocalization;


class FrontController extends Controller
{
/*
|--------------------------------------------------------------------------
| PAGES
|--------------------------------------------------------------------------
*/

    //-------------- Home Page ---------------\\
    public function index()
    {
		$categories    = Categories::orderBy('id','desc')->where('disable', 0)->get();
        $courses       = Courses::where('top_month', 1)->where('disable', 0)->inRandomOrder()->limit(6)->get();
		$faqs          = Faq::orderBy('id','desc')->where('disable', 0)->get();

        return view('front.welcome', [
            'categories'    => $categories,
            'courses'       => $courses,
            'faqs'          => $faqs,
        ]);
    }

    //-------------- About Page ---------------\\
    public function about()
    {
		$achievements  = Achievement::orderBy('id','asc')->where('disable', 0)->get();
        $teams         = Team::orderBy('id','desc')->get();

        return view('front.about', [
            'achievements'    => $achievements,
            'teams'           => $teams,
        ]);
    }

    //-------------- Courses Page ---------------\\
    public function courses()
    {
        $courses       = Courses::where('disable', 0)->orderBy('id','desc')->get();

        return view('front.courses', [
            'courses'    => $courses,
        ]);
    }

    //-------------- Course Details Page ---------------\\
    public function courseDetails($id)
    {
        $item       = Courses::where('disable', 0)->where('id',$id)->first();
        if(!$item)
        {
            abort(404);
        }

        $endofurl = '';
        if($item->link != '')
        {
            $endofurl = strrchr($item->link, '/');
        }

        $subscribed = 0;
        $user       = auth()->user();
        if($user)
        {
            $exist       = Order::where('customer_id', $user->id)->where('course_id',$id)->first();
            if($exist)
            {
                $subscribed = 1;
            }
        }

        return view('front.courseDetails', [
            'item'          => $item,
            'endofurl'      => $endofurl,
            'subscribed'    => $subscribed,
        ]);
    }

    //-------------- Contact Us Page ---------------\\
    public function contact()
    {
        return view('front.contact', [
        ]);
    }

    //-------------- Sign-in Page ---------------\\
    public function signin()
    {
        return view('front.signin', [
        ]);
    }

    //-------------- Profile Page ---------------\\
    public function profile()
    {
        $user= auth()->user();
        return view('front.profile', [
            'user'=> $user,
        ]);
    }


/*
|--------------------------------------------------------------------------
| ACTIONS
|--------------------------------------------------------------------------
*/

    //-------------- Messages ---------------\\
    public function message(Request $request)
    {
        $message1 =  Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        $receiver_email     = ReceiverEmail::first();

        $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'message' => $request->message,
        ];

        Mail::to($receiver_email->email)->send(new ContactUs($data));

        if($message1)
        {
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }

    }
    //-------------- qrCode Page ---------------\\
    public function qrCode()
    {
        $qr_codes= QrCode::orderBy('id','desc')->get();

        return view('front.qr_code', [
            'qr_codes'    => $qr_codes,
        ]);
    }
    public function qrCodeDetails($id)
    {
        $qr_codes= QrCode::where('id', $id)->orderBy('id','desc')->first();

        return view('front.qr_codeDetails', [
            'qr_codes'    => $qr_codes,
        ]);
    }



    //-------------- Edit User Info ---------------\\
    public function editprofile(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $data = $request->only(['name', 'email', 'phone', 'description']);

        $user->update($data);

        if($user)
        {
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }
    }

    //-------------- Add New Subscription ---------------\\
    public function addSubscribe(Request $request)
    {
        $order =  Order::create([
            'customer_id'   => $request->customer_id,
            'course_id'     => $request->course_id,
            'price'         => $request->price,
            'status'        => 1,
        ]);

        if($order)
        {
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }
    }

}

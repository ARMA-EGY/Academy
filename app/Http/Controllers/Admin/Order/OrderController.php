<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Courses;
use App\Http\Requests\SeoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$items          = Order::where('status',1)->orderBy('id','desc')->get();
		
        return view('admin.order.index', [
            'items' => $items,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$courses       = Courses::where('disable',0)->orderBy('id','desc')->get();
		$customers     = User::where('role','Customer')->orderBy('id','desc')->get();

        return view('admin.order.create', [
            'courses'   => $courses,
            'customers' => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $order =  Order::create([
            'customer_id'   => $request->customer_id,
            'course_id'     => $request->course_id,
            'price'         => $request->price,
            'status'        => 1,
        ]);
        
        $request->session()->flash('success', 'Subscription Added successfully');
        
        return redirect(route('order.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    //======== Remove Team ======== 
    public function remove(Request $request)
    {
        
    }
}

<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Seo;
use App\Http\Requests\SeoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$items          = Faq::orderBy('id','desc')->get();
		
        return view('admin.faq.index', [
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

        return view('admin.faq.create', [
            
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
        $faq =  Faq::create([
            'question'  => $request->question,
            'answer'    => $request->answer,
        ]);

        session()->flash('success', 'FAQ Added successfully');
        return redirect(route('faq.index'));
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

		return view('admin.faq.create', [
            'item'      => $faq,
            ]);
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

        $data = $request->only(['question','answer']);

        $faq->update($data);
        
        session()->flash('success', 'FAQ updated successfully');
        
        return redirect(route('faq.index'));
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
        $item = Faq::where('id', $request->id)->first();

        $item->delete();
    }
}

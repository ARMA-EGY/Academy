<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
		$photos             = Slider::where('lang', $lang)->orderBy('id','desc')->get();
		
        return view('admin.slider', [
            'photos' => $photos,
            'lang2' => $lang,
        ]);
    }
    

    //======== Update Photos ======== 

    public function updatephotos(Request $request)
    {
        for ($i = 0; $i < count($request->photo); $i++) 
        {
            $images = Slider::create([
                'image' => $request->photo[$i]->store('images/slider', 'public'),
                'lang' => $request->lang,
            ]);
        }

		$photos          = Slider::where('lang', $request->lang)->orderBy('id','desc')->get();

        return view('admin.modals.get_gallery_image', [
            'photos'    => $photos,
        ]);
    }
    

    //======== Remove Gallery ======== 
    public function removegallery(Request $request)
    {
        $item = Slider::where('id', $request->id)->first();

        Storage::disk('public')->delete($item->image);

        $item->delete();
    }

    //======== Get Slider Text ======== 
    public function getslidertext(Request $request)
    {
        $photo     = Slider::where('id', $request->id)->first();

        return view('admin.modals.show_slider_text', [
            'photo'    => $photo,
        ]);
    }


    //======== Update Slider Text ======== 
    public function updateslidertext(Request $request)
    {
        $photo     = Slider::where('id', $request->id)->first();

        $data = $request->only(['text']);
        $photo->update($data);

        if($photo)
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

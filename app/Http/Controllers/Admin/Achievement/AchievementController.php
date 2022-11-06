<?php

namespace App\Http\Controllers\Admin\Achievement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Achievement;
use App\Models\Countries;
use App\Models\Roles;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Image;

class AchievementController extends Controller
{

    //-------------- Get All Interests ---------------\\

    public function index()
    {
        $user = auth()->user();
		$items       = Achievement::orderBy('id','desc')->get();


        return view('admin.achievement.index', [
            'items' => $items,
           
        ]);
    }

    
    //-------------- Create New Data Page ---------------\\

    public function create()
    {
        $user = auth()->user();

        return view('admin.achievement.create');
    }


    //-------------- Store New Data ---------------\\

    public function store(Request $request)
    {
            $user = auth()->user();

            if($request->hasfile('image'))
            {
                $image = $request->file('image');
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            
                $destinationPath = public_path('/images/courses');
                ini_set('memory_limit', '256M');
                $img = Image::make($image->getRealPath());
                $img->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);
    
                $image = 'images/courses/'.$input['imagename'];
            }
            else
            {
                $image = 'images/no-image.png';
            }

            $achievement =  Achievement::create([
                'name'          => $request->name,
                'number'        => $request->number,
                'image'         => $image,
            ]);
            
            $request->session()->flash('success', 'Achievement created successfully');
            
            return redirect(route('achievements.index'));
    }


    //-------------- Edit Data Page ---------------\\
    
    public function edit(Achievement $achievement)
    {
        $user = auth()->user();
		return view('admin.achievement.create', [
            'item' => $achievement,
        ]);
    }

    
    //-------------- Update Data  ---------------\\

    public function update(Request $request, Achievement $achievement)
    {
        $user = auth()->user();
        DB::transaction(function() use ($request, $achievement) {
            $data = $request->only(['name', 'number']);

            if($request->hasfile('image'))
            {
                $image = $request->file('image');
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            
                $destinationPath = public_path('/images/courses');
                ini_set('memory_limit', '256M');
                $img = Image::make($image->getRealPath());
                $img->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);

                $image          = 'images/courses/'.$input['imagename'];
                $data['image']  = $image;
            }
            
            $achievement->update($data);

        });	
        
		session()->flash('success', 'Achievement updated successfully');
		
		return redirect(route('achievements.index'));
    }


    //-------------- Disable Data  ---------------\\

    public function disable(Request $request)
    {
        $item     = Achievement::where('id', $request->id)->first();

        if($item->disable == 1)
        {
            $disable = 0;
        }
        elseif($item->disable == 0)
        {
            $disable = 1;
        }

        $item->disable = $disable;
        $item->save();
    }
   
}

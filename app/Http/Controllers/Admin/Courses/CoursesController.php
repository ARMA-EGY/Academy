<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courses;
use App\Models\Countries;
use App\Models\Roles;
use App\Models\Categories;
use App\Models\CoursesRequest;
use App\Models\Video;
use App\Http\Requests\Course\AddRequest;
use App\Http\Requests\Course\UpdateRequest;
use Illuminate\Support\Facades\Storage;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Image;
use LaravelLocalization;
use Mail; 

class CoursesController extends Controller
{

    //-------------- Get All Data ---------------\\

    public function index()
    {
        $user = auth()->user();
		$items       = Courses::orderBy('id','desc')->get();

        return view('admin.course.index', [
            'items' => $items,
            'total_rows' => count($items),
        ]);
    }

    
    //-------------- Create New Data Page ---------------\\

    public function create()
    {
        $user = auth()->user();
        return view('admin.course.create', [
            'categories'   => Categories::where('disable', 0)->orderBy('id','desc')->get(),
            ]);
    }


    //-------------- Store New Data ---------------\\

    public function store(AddRequest $request)
    {
        $user = auth()->user();

        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('images/courses');
            ini_set('memory_limit', '2048M');
            $img = Image::make($image->getRealPath());
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $courseImage = 'images/courses/'.$input['imagename'];
        }

        $path = '';
        if ($request->hasFile('file')) 
        {
            $file = $request->file('file');
            $file_name = time().'-'.$file->getClientOriginalName();

            $destinationPath = base_path().env('PUBLIC_PATH');
            $path = 'uploads/'.$file_name;
            $file->move(base_path().'/'.env('PUBLIC_PATH').'uploads/', $file_name);
        }
        
        $course =  Courses::create([
            'name'          => $request->name,
            'price'         => $request->price,
            'category_id'   => $request->category_id,
            'image'         => $courseImage,
            'brief'         => $request->brief,
            'description'   => $request->description,
            'type'          => $request->type,
            'link'          => $request->link,
            'file'          => $path,
        ]);

        if ($request->hasFile('video_file')) 
        {
            for ($i = 0; $i < count($request->video_file); $i++) 
            {
                $file = $request->file('video_file')[$i];
                $file_name = time().'-'.$file->getClientOriginalName();
    
                $destinationPath = base_path().env('PUBLIC_PATH');
                $path2 = 'uploads/'.$file_name;
                $file->move(base_path().'/'.env('PUBLIC_PATH').'uploads/', $file_name);

                $videos = Video::create([
                    'course_id' => $course->id,
                    'name'      => $request->video_name[$i],
                    'path'      => $path2,
                ]);
            }
        }
        
    }


    //-------------- Edit Data Page ---------------\\
    
    public function edit(courses $course)
    {
        $user = auth()->user();
		return view('admin.course.create', [
            'item' => $course,
            'categories'   => Categories::where('disable', 0)->orderBy('id','desc')->get(),
        ]);
    }

    
    //-------------- Update Data  ---------------\\

    public function update(UpdateRequest $request, courses $course)
    {

        $user = auth()->user();
        $data = $request->only(['name', 'price', 'category_id', 'description', 'type', 'link', 'brief']);

        if($request->hasfile('image'))
        {
            $file_pointer = public_path().'/'.$course->image;
            if(file_exists($file_pointer) && isset($course->image))
            {
              unlink($file_pointer);
            }

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('/images/courses');
            ini_set('memory_limit', '2048M');
            $img = Image::make($image->getRealPath());
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $courseImage = 'images/courses/'.$input['imagename'];

            $data['image'] = $courseImage;
        }
           
        if ($request->hasFile('file')) 
        {
            $file = $request->file('file');
            $file_name = time().'-'.$file->getClientOriginalName();

            $destinationPath = base_path().env('PUBLIC_PATH');
            $path = 'uploads/'.$file_name;
            $file->move(base_path().'/'.env('PUBLIC_PATH').'uploads/', $file_name);

            $data['file'] = $path;
        }

        $course->update($data);

		// session()->flash('success', 'Course was updated successfully');
		
		// return redirect(route('courses.index'));
    }


    //-------------- Disable Data  ---------------\\

    public function disable(Request $request)
    {
        $item     = Courses::where('id', $request->id)->first();

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

    //-------------- Delete Data  ---------------\\

    public function delete(Request $request)
    {
        $item   = Courses::where('id', $request->id)->first();
        $delete = $item->delete();

        if($delete)
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

    //-------------- Get Active Data ---------------\\

    public function requestes()
    {
        $user = auth()->user();
        $items       = CoursesRequest::orderBy('id','desc')->get();
        
        return view('admin.course.requests', [
            'items' => $items,
            'total_rows' => count($items),
        ]);
    }


    //-------------- Disable Data  ---------------\\

    public function accept(Request $request)
    {
        $item     = CoursesRequest::where('id', $request->id)->first();

        if($item->accept == 1)
        {
            $accept = 0;
        }
        elseif($item->accept == 0)
        {
            $accept = 1;
        }

        $item->accept = $accept;
        $item->save();
    }


    //-------------- Top of Month  ---------------\\

    public function topMonth(Request $request)
    {
        $item     = Courses::where('id', $request->id)->first();

        if($item->top_month == 1)
        {
            $top_month = 0;
        }
        elseif($item->top_month == 0)
        {
            $top_month = 1;
        }

        $item->top_month = $top_month;
        $item->save();
    }


    //-------------- Remove Video ---------------\\
    public function removeVideo(Request $request)
    {
        $item       = Video::where('id', $request->id)->first();
        $path       = public_path().'/'.$item->path;

        unlink($path);
        $item->delete();
    }
   
}

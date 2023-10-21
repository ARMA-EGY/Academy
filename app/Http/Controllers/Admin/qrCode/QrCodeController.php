<?php

namespace App\Http\Controllers\Admin\qrCode;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\AddRequest;
use App\Http\Requests\Staff\UpdateRequest;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Image;

class QrCodeController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
		$items       = QrCode::orderBy('id','desc')->get();

        return view('admin.qrCode.index', [
            'items' => $items,
            'total_rows' => count($items),
        ]);
    }
    public function create()
    {
        $user = auth()->user();
        return view('admin.qrCode.create');
    }
    public function store(Request $request)
    {
        $user = auth()->user();

        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('images/qrcode');
            ini_set('memory_limit', '2048M');
            $img = Image::make($image->getRealPath());
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $courseImage = 'images/qrcode/'.$input['imagename'];
        }
        $QrCode =  QrCode::create([
            'title'          => $request->title,
            'description'   => $request->description,
            'image'         => $courseImage,
        ]);
        
        $request->session()->flash('success', 'qrcode Was Added successfully');
        return redirect(route('qrcode.index'));
    }
    public function edit(qrcode $qrcode)
    {
        $user = auth()->user();
		return view('admin.qrcode.create', [
            'item' => $qrcode,
        ]);
    }
    public function update(Request $request, qrcode $qrcode)
    {
        $user = auth()->user();
        $data = $request->only(['title', 'description']);

        if($request->hasfile('image'))
        {
            $file_pointer = public_path().'/'.$qrcode->image;
            if(file_exists($file_pointer) && isset($qrcode->image))
            {
              unlink($file_pointer);
            }

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('/images/qrcode');
            ini_set('memory_limit', '2048M');
            $img = Image::make($image->getRealPath());
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $courseImage = 'images/qrcode/'.$input['imagename'];

            $data['image'] = $courseImage;
        }
            

        $qrcode->update($data);

		session()->flash('success', 'qrcode was updated successfully');
		
		return redirect(route('qrcode.index'));
    }
    //-------------- Disable Data  ---------------\\
    
    public function delete(qrcode $qrcode)
    {
        $item = QrCode::where('id', $qrcode->id)->first();
        $item->delete();
        $items= QrCode::orderBy('id','desc')->get();

        return view('admin.qrCode.index', [
            'items' => $items,
            'total_rows' => count($items),
        ]);
    }
}

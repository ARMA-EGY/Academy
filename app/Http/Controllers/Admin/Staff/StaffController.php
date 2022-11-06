<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use App\Models\Roles;
use App\Http\Requests\Staff\AddRequest;
use App\Http\Requests\Staff\UpdateRequest;
use Illuminate\Support\Facades\Storage;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Image;

class StaffController extends Controller
{

    use RegistersUsers;

    //-------------- Get All Data ---------------\\

    public function index()
    {
        $user = auth()->user();
		$items       = User::where('role','Admin')->orderBy('id','desc')->get();

        return view('admin.staff.index', [
            'items' => $items,
            'total_rows' => count($items),
        ]);
    }

    
    //-------------- Create New Data Page ---------------\\

    public function create()
    {
        $user = auth()->user();
        return view('admin.staff.create', [
            'countries'   => Countries::all(),
            ]);
    }


    //-------------- Store New Data ---------------\\

    public function store(AddRequest $request)
    {
        $user = auth()->user();

        if($request->hasfile('avatar'))
        {
            $image = $request->file('avatar');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('/images/avatars');
            ini_set('memory_limit', '256M');
            $img = Image::make($image->getRealPath());
            $img->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $avatar = 'images/avatars/'.$input['imagename'];
        }
        else
        {
            if ($request->gender == 'Male')
            {
                $avatar = 'images/male.png';
            }
            else
            {
                $avatar = 'images/female.png';
            }
        }

        $staff =  User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'nationality' => $request->nationality,
            'avatar' => $avatar,
            'role' => 'Admin',
            'password' => Hash::make($request->password),
        ]);
        
        $request->session()->flash('success', 'Staff Added successfully');
        
        return redirect(route('staff.index'));
    }


    //-------------- Edit Data Page ---------------\\
    
    public function edit(User $staff)
    {
        $user = auth()->user();
		return view('admin.staff.create', [
            'item' => $staff,
            'countries'   => Countries::all(),
        ]);
    }

    
    //-------------- Update Data  ---------------\\

    public function update(UpdateRequest $request, User $staff)
    {

        $user = auth()->user();
        $data = $request->only(['name', 'phone', 'email', 'gender', 'birthdate', 'nationality']);

        if($request->hasfile('avatar'))
        {
            $image = $request->file('avatar');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('/images/avatars');
            ini_set('memory_limit', '256M');
            $img = Image::make($image->getRealPath());
            $img->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $avatar = 'images/avatars/'.$input['imagename'];

            $data['avatar'] = $avatar;
        }
           

        $staff->update($data);
		
		session()->flash('success', 'Staff updated successfully');
		
		return redirect(route('staff.index'));
    }


    //-------------- Show Data  ---------------\\

    public function profile($id)
    {
        $user = auth()->user();
        $item     = User::where('id', $id)->first();

        return view('admin.staff.profile', [
            'item' => $item,
        ]);
    }


    //-------------- Disable Data  ---------------\\

    public function disable(Request $request)
    {
        $item     = User::where('id', $request->id)->first();

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

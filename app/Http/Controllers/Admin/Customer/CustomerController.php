<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use App\Models\Roles;
use Illuminate\Support\Facades\Storage;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Image;

class CustomerController extends Controller
{

    use RegistersUsers;

    //-------------- Get All Data ---------------\\

    public function index()
    {
        $user = auth()->user();
		$items       = User::where('role','Customer')->orderBy('id','desc')->get();

        return view('admin.customer.index', [
            'items' => $items,
            'total_rows' => count($items),
        ]);
    }

    
    //-------------- Create New Data Page ---------------\\

    public function create()
    {
        $user = auth()->user();
        return view('admin.customer.create', [
            'countries'   => Countries::all(),
            ]);
    }


    //-------------- Store New Data ---------------\\

    public function store(AddRequest $request)
    {
        $user = auth()->user();

        $customer =  User::create([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'role'      => 'Customer',
            'password'  => Hash::make($request->password),
        ]);
        
        $request->session()->flash('success', 'Customer Added successfully');
        
        return redirect(route('customer.index'));
    }


    //-------------- Edit Data Page ---------------\\
    
    public function edit(User $customer)
    {
        $user = auth()->user();
		return view('admin.customer.create', [
            'item' => $customer,
            'countries'   => Countries::all(),
        ]);
    }

    
    //-------------- Update Data  ---------------\\
    public function update(Request $request, User $customer)
    {
        $user = auth()->user();
        $data = $request->only(['name', 'phone', 'email']);

        $customer->update($data);
		
		session()->flash('success', 'Customer updated successfully');
		
		return redirect(route('customer.index'));
    }


    //-------------- Show Data  ---------------\\

    public function profile($id)
    {
        $user = auth()->user();
        $item     = User::where('id', $id)->first();

        return view('admin.customer.profile', [
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

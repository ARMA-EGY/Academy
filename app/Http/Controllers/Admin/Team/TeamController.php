<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Seo;
use App\Http\Requests\SeoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$items          = Team::orderBy('id','desc')->get();
		
        return view('admin.team.index', [
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
        return view('admin.team.create', [
            
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
        //dd($request->description);
        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
    
        $destinationPath = public_path('images/team');
        //ini_set('memory_limit', '256M');
        $img = Image::make($image->getRealPath());
        $img->save($destinationPath.'/'.$input['imagename']);

        $teamImage = 'images/team/'.$input['imagename'];

        $team =  Team::create([
            'name' => $request->name,
            'title' => $request->title,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'image' => $teamImage,
        ]);

        session()->flash('success', 'Member Added successfully');
        
        return redirect(route('team.index'));
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
    public function edit(Team $team)
    {
		return view('admin.team.create', [
            'item'      => $team,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {

        $data = $request->only(['name', 'title', 'phone', 'email', 'description', 'facebook', 'twitter', 'instagram', 'linkedin']);

        if($request->hasfile('image'))
        {

            $file_pointer = public_path().'/'.$team->image;
            if(file_exists($file_pointer) && isset($team->image))
            {
              unlink($file_pointer);
            }

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('/images/team');
            //ini_set('memory_limit', '256M');
            $img = Image::make($image->getRealPath());
            $img->save($destinationPath.'/'.$input['imagename']);

            $teamImage = 'images/team/'.$input['imagename'];

            $data['image'] = $teamImage;
        }

        $team->update($data);
        
        session()->flash('success', 'Member updated successfully');
        
        return redirect(route('team.index'));
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
    public function removeteam(Request $request)
    {
        $item = Team::where('id', $request->id)->first();

        $file_pointer = public_path().'/'.$item->image;
        if(file_exists($file_pointer) && isset($item->image))
        {
          unlink($file_pointer);
        }

        $item->delete();

    }
}

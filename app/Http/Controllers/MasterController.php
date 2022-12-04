<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LogoRequest;

use App\Models\User;
use App\Models\Logo;
use App\Models\Todo;
use App\Models\Note;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Countries;

use App\Models\Categories;
use App\Models\Courses;
use App\Models\CoursesRequest;
use App\Models\Team;
use App\Models\Order;

use App\Models\Message;
use App\Models\Social;
use App\Models\Subscriber;
use App\Models\ReceiverEmail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Image;

class MasterController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */


/*
|--------------------------------------------------------------------------
| PAGES
|--------------------------------------------------------------------------
*/

    //-------------- Home Page ---------------\\
    public function index()
    {
        $user        = auth()->user();
		$items       = Courses::where('disable',0)->orderBy('id','desc')->limit(10)->get();

        return view('admin.home', [
            'items'                 => $items,
            'team_count'            => Team::all()->count(),
            'courses_count'         => Courses::where('disable', 0)->count(),
            'messages_count'        => Message::all()->count(),
            'subscribers_count'     => Subscriber::all()->count(),
            'orders_count'          => Order::where('status', 1)->count(),
            'categories_count'      => Categories::where('disable', 0)->count(),
            'customers_count'       => User::where('role', 'Customer')->count(),
        ]);
    }

    //-------------- Profile Page ---------------\\
    public function profile()
    {
        $user = auth()->user();
        
        return view('admin.profile', [
            'countries'   => Countries::all(),
            ]);
        
    }
    
    //-------------- Logo Page ---------------\\
    public function logo()
    {
        $logo     = Logo::first();

        return view('admin.logo', [
            'logo'    => $logo
        ]);
    }
    
    //-------------- Setting Page ---------------\\
    public function setting()
    {
        $setting     = Setting::first();

        return view('admin.setting', [
            'setting'    => $setting
        ]);
    }
    
    //-------------- Messages Page ---------------\\
    public function messages()
    {
        $messages     = Message::orderBy('id','desc')->paginate(10);

        return view('admin.messages', [
            'messages'    => $messages
        ]);
    }

    //-------------- Subscribers Page ---------------\\
    public function subscribers()
    {
        $subscribers     = Subscriber::orderBy('id','desc')->paginate(10);

        return view('admin.subscribers', [
            'items'    => $subscribers
        ]);
    }

    //-------------- Social Media Page ---------------\\
    public function socialmedia()
    {
        $socials         = Social::orderBy('id','desc')->paginate(10);

        return view('admin.socialmedia', [
            'socials'    => $socials,
        ]);
    }

/*
|--------------------------------------------------------------------------
| ACTIONS
|--------------------------------------------------------------------------
*/

    //-------------- Social Media ---------------\\
    public function social(Request $request)
    {
        
        Social::truncate();

        for ($i = 0; $i < count($request->platform); $i++) 
        {
            $socials[] = [
                'platform' => $request->platform[$i],
                'link' => $request->link[$i],
                'off' => $request->off[$i]
            ];
        }

        $social =  Social::insert($socials);

        if($social)
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

    //-------------- Get Receiver Email ---------------\\
    public function getreceiveremail()
    {
        $email     = ReceiverEmail::first();

        return view('admin.modals.receiver_email', [
            'email'    => $email
        ]);
    }

    //-------------- Get Message ---------------\\
    public function getmessage(Request $request)
    {
        $message     = Message::find($request->id);

        $message->open = 1;
        $message->save();

        return view('admin.modals.show_message', [
            'message'    => $message
        ]);
    }

    //-------------- Receiver Email ---------------\\
    public function receiveremail(Request $request)
    {
        ReceiverEmail::truncate();

        $create =  ReceiverEmail::create([
            'email' => $request->email,
        ]);

        if($create)
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

    //-------------- Change Logo ---------------\\
    public function changelogo(LogoRequest $request)
    {

        $old_logo     = Logo::first();

        if($old_logo)
        {
            Storage::disk('public')->delete($old_logo->logo);
        }

        Logo::truncate();

        $create =  Logo::create([
            'logo' => $request->logo->store('images/logo', 'public')
        ]);

        return redirect(route('admin-logo'));
    }

    //-------------- Edit Setting Data ---------------\\
    public function editsetting(Request $request)
    {
            
        $setting     = Setting::first();
        $data = $request->only(['project_name', 'phone', 'email', 'address', 'dollar']);
           
        if($request->hasfile('logo'))
        {
            Storage::disk('public')->delete($setting->logo);
            $logo           = $request->logo->store('images/logo', 'public');
            $data['logo']   = $logo;
        }

        $setting->update($data);

        if($setting)
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

    //-------------- Edit User Info ---------------\\
    public function editinfo(UpdateUserRequest $request)
    {
            $user            = User::where('id', $request->id)->first();

            $data = $request->only(['name', 'email', 'gender', 'phone', 'birthdate', 'nationality']);

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

    //-------------- Change Profile Picture ---------------\\
    public function changeProfilePicture(Request $request)
    {
            $user            = User::where('id', $request->id)->first();
            $image_path      = public_path().'/'.$user->avatar;

            $image = $request->file('avatar');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        
            $destinationPath = public_path('/images/avatars');
            ini_set('memory_limit', '256M');
            $img = Image::make($image->getRealPath());
            $img->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $avatar = 'images/avatars/'.$input['imagename'];

            $user->avatar     = $avatar;
            $user->save();

            unlink($image_path);

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

    //-------------- Change Password ---------------\\
    public function changepassword(Request $request)
    {
            $user            = User::where('id', $request->id)->first();
            $old_password    = Hash::make($request->oldpassword);
            $new_password    = Hash::make($request->newpassword);

            $check  = Hash::check($request->oldpassword, $user->password);


            if($request->oldpassword == '')
            {
                return response()->json([
                'status' => 'error',
                'msg' => 'Current Password Required'
                ]) ;
            }
            elseif($request->newpassword == '')
            {
                return response()->json([
                'status' => 'error',
                'msg' => 'New Password Required'
                ]) ;
            }
            elseif(strlen($request->newpassword)  < 8)
            {
                return response()->json([
                'status' => 'error',
                'msg' => 'The password must be at least 8 characters.'
                ]) ;
            }
            elseif(!$check)
            {
                return response()->json([
                'status' => 'error',
                'msg' => 'Current password is wrong'
                ]) ;
            }

            $data['password'] = $new_password;
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

    //-------------- Add Todo ---------------\\
    public function addtodo(Request $request)
    {
            $todo = Todo::create([
                'task' => $request->task,
                'user_id' => $request->user_id,
            ]);

            $todos   = Todo::where('user_id', $request->user_id)->get();

            return view('apps.todo', [
                'todos'    => $todos,
            ]);
    }

    //-------------- Get Todo ---------------\\
    public function gettodo(Request $request)
    {
            $todos   = Todo::where('user_id', $request->id)->get();

            return view('apps.todo', [
                'todos'    => $todos,
            ]);
    }

    //-------------- Edit Todo ---------------\\
    public function edittodo(Request $request)
    {
            $todo   = Todo::where('id', $request->id)->first();

            if($todo->done == 1)
            {
                $done = 0;
            }
            elseif($todo->done == 0)
            {
                $done = 1;
            }

            $todo->done = $done;
            $todo->save();
    }

    //-------------- Remove Todo ---------------\\
    public function removetodo(Request $request)
    {
        $todo   = Todo::where('id', $request->id)->first();

        $todo->delete();
    }

    //-------------- Create Note ---------------\\
    public function createnote()
    {
        return view('apps.show_note', []);
    }

    //-------------- Add Note ---------------\\
    public function addnote(Request $request)
    {
            $note = Note::create([
                'title' => $request->title,
                'text' => $request->text,
                'user_id' => $request->user_id,
            ]);

            $notes   = Note::where('user_id', $request->user_id)->get();

            return view('apps.note', [
                'notes'    => $notes,
            ]);
    }

    //-------------- Get Note ---------------\\
    public function getnote(Request $request)
    {
            $notes   = Note::where('user_id', $request->id)->get();

            return view('apps.note', [
                'notes'    => $notes,
            ]);
    }

    //-------------- Show Note ---------------\\
    public function shownote(Request $request)
    {
            $note   = Note::where('id', $request->id)->first();

            return view('apps.show_note', [
                'note'    => $note,
            ]);
    }

    //-------------- Edit Note ---------------\\
    public function editnote(Request $request)
    {
            $note   = Note::where('id', $request->note_id)->first();

            $note->title = $request->title;
            $note->text = $request->text;
            $note->save();

            $notes   = Note::where('user_id', $note->user_id)->get();

            return view('apps.note', [
                'notes'    => $notes,
            ]);
    }

    //-------------- Remove Note ---------------\\
    public function removenote(Request $request)
    {
        $note   = Note::where('id', $request->id)->first();

        $note->delete();
    }

    //-------------- View Calendar ---------------\\
    public function calendar(Request $request)
    {
            return view('calendar', [ ]);
    }

    //-------------- Get Events ---------------\\
    public function getevent($user_id)
    {
        $events   = Event::where('user_id', $user_id)->get();
            
        foreach($events as $event)
        {
            $data[] = array(
            'id'   	        => $event["id"],
            'title'         => html_entity_decode($event["title"],ENT_QUOTES | ENT_XML1,'UTF-8'),
            'description'   => $event["description"],
            'start'         => $event["start_date"],
            'end'   	    => $event["end_date"],
            'className'     => $event["class_name"],
            'allDay'        => '!0'

            );
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    //-------------- Add Event ---------------\\
    public function addevent(Request $request)
    {
            $event = Event::create([
                'title' => $request->title,
                'user_id' => $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'class_name' => $request->class_name,
            ]);
    }

    //-------------- Remove Event ---------------\\
    public function removeevent(Request $request)
    {
        $event   = Event::where('id', $request->id)->first();

        $event->delete();
    }

    //-------------- Edit Event ---------------\\
    public function editevent(Request $request)
    {
            $event   = Event::where('id', $request->event_id)->first();

            $event->title           = $request->title;
            $event->description     = $request->description;
            $event->class_name      = $request->class_name;
            $event->save();
    }

    //-------------- Update Event  ---------------\\
    public function updateevent(Request $request)
    {
            $event   = Event::where('id', $request->event_id)->first();

            $event->start_date     = $request->start_date;
            $event->end_date       = $request->end_date;
            $event->save();
    }

}

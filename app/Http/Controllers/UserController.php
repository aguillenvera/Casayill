<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use App\Models\Notificacion;
use App\Models\{User, Role};


class UserController extends Controller
{
    public function index()
    { 
    
         $users = User::all();
    
        
        //$users = User::all();
        return view('users.index', compact("users"));
    }
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact( "roles"));
    }
    public function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required', 'email'=>'required', 'password'=>'required', 'direccion' => 'string', 'telefono' => 'string' ]);
        
        $temp = new User();
        $temp->name = $request->get('name');
        $temp->last_name = $request->get('last_name');
        $temp->username = $request->get('username');
        $temp->email = $request->get('email');
        $temp->password = bcrypt($request->get('password'));
        $temp->role()->associate($request->get('role'));
        $temp->region_id = $request->get('region');

  
        $temp->save();
        
        $content = new \stdClass();
        $content->receiver = $request->get('name');

        return redirect()->route('users.index')->with('success','User created successfully');
    }
    public function show($id)
    {
        $user=user::find($id);
        return  view('users.index',compact('users'));
    }
    public function edit($id)
    {
        $user = user::find($id);
        $roles = Role::all();
        

        return view('users.edit', compact(['user','roles']));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function admin_credential_rules(array $data)
    {
        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'same:password',
            'password-confirmation' => 'same:password',
        ], [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ]);
    
        return $validator;
    }

    public function postCredentials(Request $request)
    {
        if(Auth::Check()){
            $request_data = $request->All();

            $validator = $this->admin_credential_rules($request_data);

            if($validator->fails()){
                return redirect()->route('profile')->with('success',array('error' => $validator->getMessageBag()->toArray()));
            }else{
                $current_password = Auth::User()->password;
                


                if(Hash::check($request_data['current-password'], $current_password)){
                   
                if($request->hasfile('upload_photo')){
                    $file = $request->file('upload_photo');
                    $name=time().$file->getClientOriginalName();
        
                    $file->move(public_path().'/img/profile/', $name);    
                }
  
                    $user_id = Auth::User()->id;
               
                    $obj_user = User::find($user_id);
                    $obj_user->name = $request_data['name'];
                    $obj_user->email = $request_data['email'];
                    if($request->hasfile('upload_photo')){
                    $obj_user->profile_photo = $name;
                }
                    if(($request_data['password']) != null && ($request_data['password']) != '')
                    $obj_user->password = Hash::make($request_data['password']);
                    $obj_user->save();
                    return redirect()->route('profile')->with('success','User data update');
                }else{
                    return redirect()->route('profile')->with('success','Please enter correct current password');
                }
            }
        }else
            return redirect()->to('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[ 'name'=>'required', 'email'=>'required', 'role' => 'required']);

        $temp = User::find($id);
        $temp->name = $request->get('name');
        $temp->last_name = $request->get('last_name');
        $temp->username = $request->get('username');
        $temp->email = $request->get('email');
        $temp->role()->associate($request->get('role'));
        $temp->region_id = $request->get('region');
        $temp->store_code = $request->get('store');
        $temp->save();

        if($request->get('role') == 1){
            return to_route('users.index')->with('success','User update');
        }else{
            return to_route('users.index')->with('success','Data update');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return to_route('users.index')->with('success','User Borrado');
    }
}

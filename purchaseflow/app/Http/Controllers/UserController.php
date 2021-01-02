<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->get()->sortBy('lastname');
        return view('user.index')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $roles = ['administrator','manager','employee'];
        return view('user.create')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'  =>  'required|regex:/[a-zA-Z0-9]{7}/',
            'firstname' =>  'required|regex:/[a-zA-Z]/',
            'lastname'  =>  'required|regex:/[a-zA-Z]/',
            'email'     =>  'required|email',
            'role'      =>  'required',
            'password'  =>  'required|regex:/^[a-zA-Z0-9]{8,16}/',
            // 'passwordConf'=> 'required|regex:/^[a-zA-Z0-9]{8,16}/'

        ]);
        $user = new User();
        $user->username     = $request->get('username');
        $user->firstname    = $request->get('firstname');
        $user->lastname     = $request->get('lastname');
        $user->email        = $request->get('email');
        $user->role         = $request->get('role');
        $user->password     = $request->get('password');
        // $user->passwordConf     = $request->get('passwordConf');
        // if($user->password != $user->passwordConf) {
        //     return redirect()->route('user.create')->with('message','password does not match');
        // }
        

        $user->password     = Hash::make($user->password);
        //$user->password     = password_hash($user->password,PASSWORD_DEFAULT);

        $exists = DB::table('users')->where('email',$user->email)->exists();
        if($exists) {
            return redirect()->route('user.index')->with('message','User already in database');
        }
        else{
            $user->save();
            return redirect()->route('user.index')->with('success','User created with success');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       
        return view('user.show',compact('user',$user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = ['administrator','manager','employee'];
        
        return view('user.edit',compact('user',$user))->with('roles',$roles);
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
        $user = User::findOrFail($id);
        $request->validate([
            'username'  =>  'required|regex:/[a-zA-Z0-9_]{8}/',
            'firstname' =>  'required|regex:/[a-zA-Z]/',
            'lastname'  =>  'required|regex:/[a-zA-Z]/',
            'email'     =>  'required|email',
            'password'  =>  'required|regex:/^[a-zA-Z0-9.!#$%&\'*+/=?_`{|}~-]{8,16}/'

        ]);
       
        $user->username     = $request->get('username');
        $user->firstname    = $request->get('firstname');
        $user->lastname     = $request->get('lastname');
        $user->email        = $request->get('email');
        $user->role         = $request->get('role');
        $user->password     = $request->get('password');
        $user->password     = Hash::make($user->password);
        //$user->password     = password_hash($user->password,PASSWORD_DEFAULT);

        $exists = DB::table('users')->where('email',$user->email)->exists();
        if($exists) {
            return redirect()->route('user.index')->with('message','User already in database');
        }
        else{
            $user->save();
            return redirect()->route('user.index')->with('success','User updated with success');
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
        //
    }


}

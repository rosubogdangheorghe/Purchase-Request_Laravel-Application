<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->get()->sortBy('lastname');
        return view('password.index')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        return view('password.edit',compact('user',$user));
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
        $request ->validate([
            'password'  =>  'required|regex:/^[a-zA-Z0-9]{8,16}/',
            'passwordConf'=> 'required|regex:/^[a-zA-Z0-9]{8,16}/'
        ]);
        $user->password     = $request->get('password');
        $user->passwordConf     = $request->get('passwordConf');
        if($user->password != $user->passwordConf) {
                 return redirect()->route('password.edit')->with('message','password does not match');
         }
         $user->password     = Hash::make($user->password);
         $user->save();
         return redirect()->route('password.index')->with('success','Password changed suucessfuly');
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

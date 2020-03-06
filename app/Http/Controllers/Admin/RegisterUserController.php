<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterUserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('adminpassword',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = User::getDefaultCampuses();
        $users = User::get();
        $roles = Role::get();
        return view('admin.manage-users', compact('users','campuses','roles'));
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
        $this->validate(request(),[
            'name'      =>  ['required', 'string', 'max:255', 'unique:users,name'],
            'position'  =>  ['required'],
            'email'     =>  ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'  =>  ['required', 'string', 'min:8', 'confirmed']
        ]);
        
        User::create([
            'name'              =>      $request->name,
            'position'          =>      $request->position,
            'campuses'          =>      $request->campuses,
            'email'             =>      $request->email,
            'password'          =>      Hash::make($request->password),
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $register_user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $register_user)
    {
        $campuses = User::getDefaultCampuses();
        return view('admin.crud-form.edit-user', compact('register_user', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $register_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $register_user)
    {
        $register_user->name = $request->name;
        $register_user->position = $request->position;
        $register_user->campuses = $request->campuses;
        $register_user->save();
        alert()->success('Successfully Updated!')->persistent('Ok');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Successfully deleted!']);
    }
    public function assignRole(User $user, Request $request)
    {
        $user->roles()->detach();
        
        if ($request->role_user) 
        {
            $user->roles()->attach(Role::where('name', 'role_user')->first());
        }
        if ($request->role_admin) 
        {
            $user->roles()->attach(Role::where('name', 'role_admin')->first());
        }
        if ($request->role_director) 
        {
            $user->roles()->attach(Role::where('name', 'role_director')->first());
        }
        alert()->success('Successfully assigned!')->persistent('Ok');
        return redirect()->back();
    }
    public function updateUserAccount(User $user, Request $request)
    {
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        alert()->success('Successfully Updated!')->persistent('Ok');
        return redirect()->back();
    }
}

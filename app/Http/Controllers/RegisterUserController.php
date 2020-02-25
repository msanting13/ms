<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Hash;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $campuses = User::getDefaultCampuses();
        return view('admin.crud-form.edit-user', compact('user', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->position = $request->position;
        $user->campuses = $request->campus;
        $user->save();
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
        //
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
        alert()->success('Success!')->persistent('Ok');
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

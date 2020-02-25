<?php

namespace App\Http\Controllers;

use App\User;
use Alert;
use Hash;
//use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AccountSettingsController extends Controller
{
    public function __construct()
    {
        $this->photos_path = public_path('/assets/images/users/');
        //$this->thumbnail_path = public_path('/assets/images/users/thumbnail/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = User::getDefaultCampuses();
        return view('account-settings.account-settings', compact('campuses'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $setting)
    {
        $setting->name = $request->name;
        $setting->position = $request->position;
        $setting->campuses = $request->campuses;
        $setting->save();
        alert()->success('Successfully Updated!')->persistent('Ok');
        return redirect()->back(); 
    }

    public function updateCredentials(Request $request, User $setting)
    {
        $this->validator($request->all())->validate();
        if (!Hash::check($request->currentpassword, $setting->password)) 
        {
            return back()->withErrors([
                'currentpassword' => 'Current Password does not match',
            ]);
        }
        $setting->password = Hash::make($request->password);
        $setting->save();
        return redirect()->back()->with('success','Successfully changed!');
    }
    public function changeProfilePicture(Request $request, User $setting)
    {

        $this->validate(request(),[
            'image'         =>       'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ],
        [
            'image.image'   =>        'Profile picture must be an image'
        ]);

        if (!is_dir($this->photos_path)) 
        {
            mkdir($this->photos_path, 0777);
        }

        $photo = $request->file('image');
        $new_name = rand(). '.' . $photo->getClientOriginalExtension();
        $is_move = $photo->move($this->photos_path, $new_name);
        if ($is_move) {
            $setting->picture = $new_name;
            $setting->save();
        }
        return redirect()->back()->with('success','Successfully changed!');
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'currentpassword' => ['required', 'string', 'min:6'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'different:currentpassword']
        ]);
    }
}

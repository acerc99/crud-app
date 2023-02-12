<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Skill;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $i = 1;
        return view('users.index', compact('users', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $skills = Skill::all();
        return view('users.create', compact('states', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
        ]);
      
        User::create($request->all());
        // dd(1);
        return redirect()->route('users.index')
                        ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // dd($user);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
        //
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

    public function updateProfile(Request $request)
{
    // validate the form inputs
    $validatedData = $request->validate([
        // other validation rules
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // get the image file
    $image = $request->file('profile_ picture');

    // generate a unique file name
    $fileName = time().'.'.$image->getClientOriginalExtension();

    // save the image to the public/images folder
    $image->move(public_path('images'), $fileName);

    // save the file name to the database
    // $user = Auth::user();
    $user->profile_picture = $fileName;
    $user->save();

    // redirect the user back with a success message
    return redirect()->back()->with('success', 'Profile picture updated successfully');
    }   
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status',1)->get();
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
        // dd($request->input('city'));
        $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_no' => 'required|numeric|digits:10',
            'image' => 'required',
            
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $files = [];
        if ($request->hasFile('cert_images')){
            foreach ($request->file('cert_images') as $file){
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $files[] = $fileName;
            }
        }
       
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->profession = $request->input('profession');
        $user->mobile_no = $request->input('mobile_no');
        $user->state_id = $request->input('state');
        $user->city_id = $request->input('city');
        $user->image = $imageName;
        $user->status = 1;
        $user->have_certificates = json_encode($files);
        $user->have_skills = json_encode($request->input('skills'));
        $user->edu_year = json_encode($request->input('year'));
        $user->degree = json_encode($request->input('degree'));
        $user->company_name = $request->input('companyName') ?? null;
        $user->date_of_joining = $request->input('doj') ?? null;
        $user->business_name = $request->input('bussinessName') ?? null;
        $user->location = $request->input('location') ?? null;
        $user->save();

        // $user->saveUser($request->all()->with($imageName));
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
        $get_state = State::find($user->state_id);
        $state_name = $get_state['name'];
        $get_city = City::find($user->city_id);
        $city_name = $get_city['name'];
        $files = json_decode($user->have_certificates, true);
        // dd($files);
        $years = json_decode($user->edu_year, true);
        $degrees = json_decode($user->degree, true);
        $pairs = [];
        for ($i = 0; $i < count($years); $i++) {
            $pairs[] = [$years[$i], $degrees[$i]];
        }
        // dd($pairs);
        
        $skills = json_decode($user->have_skills, true); 
        // dd($years);


        return view('users.show', compact('user', 'years','degrees','files', 'skills', 'pairs','state_name', 'city_name' ));
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
        $states = State::all();
        $skills = Skill::all();
        return view('users.edit', compact('user', 'states', 'skills'));
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
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,'. $user->id, 
            'mobile_no' => 'required|numeric|digits:10',
            'image' => 'required',

        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $files = [];
        if ($request->hasFile('cert_images')){
            foreach ($request->file('cert_images') as $file){
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $files[] = $fileName;
            }
        }
        
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->profession = $request->input('profession');
        $user->mobile_no = $request->input('mobile_no');
        $user->state_id = $request->input('state');
        $user->city_id = $request->input('city');
        $user->image = $imageName;
        $user->have_certificates = json_encode($files);
        $user->have_skills = json_encode($request->input('skills'));
        $user->edu_year = json_encode($request->input('year'));
        $user->degree = json_encode($request->input('degree'));
        $user->company_name = $request->input('companyName') ?? null;
        $user->date_of_joining = $request->input('doj') ?? null;
        $user->business_name = $request->input('bussinessName') ?? null;
        $user->location = $request->input('location') ?? null;
        $user->save();

        // $user->saveUser($request->all()->with($imageName));
        return redirect()->route('users.index')
                        ->with('success','User Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->save();
        return redirect()->route('users.index');
    }  

    public function delete($id)
    {
        
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->save();
        return redirect()->route('users.index');
    }  

}

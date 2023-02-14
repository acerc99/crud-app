@extends('layouts.layout')
 
@section('content')

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-12 col-xl-4">
  
          <div class="card" style="border-radius: 15px;">
            <div class="card-body text-center">
              <div class="mt-3 mb-4">
                <img src="{{ asset('images/'. $user->image) }}" alt="Profile Photo"
                  class="rounded-circle img-fluid" style="width: 100px;" />
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Name:</h5>
                <h5 class="mb-2">{{ $user->name }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">DOB:</h5>
                <h5 class="mb-2">{{ date('d-m-Y', strtotime($user->dob)) }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Gender:</h5>
                <h5 class="mb-2">{{ $user->gender }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">State:</h5>
                <h5 class="mb-2">{{ $state_name }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">City:</h5>
                <h5 class="mb-2">{{ $city_name }}</h5>
              </div>

              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Email:</h5>
                <h5 class="mb-2">{{ $user->email }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Mobile No:</h5>
                <h5 class="mb-2">{{ $user->mobile_no }}</h5>
              </div>

              <p><h5 class="mb-2">Profession:</h5></p>
              <div class="d-flex justify-content-between">
                @if ($user->profession == 1)
                <h5 class="mb-2">Company Name:</h5>
                <h5 class="mb-2">{{ $user->company_name }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Date of Joining:</h5>
                <h5 class="mb-2">{{ date('d-m-Y', strtotime($user->date_of_joining))}}</h5>
              </div>
              @elseif ($user->profession == 2)
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">business Name:</h5>
                <h5 class="mb-2">{{ $user->business_name }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Location:</h5>
                <h5 class="mb-2">{{ $user->location }}</h5>
              </div>
              @endif
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Skills:</h5>
                @foreach ($skills as $skill)
                <h5 class="mb-2">{{ $skill }}</h5>
                @endforeach
              </div>

              <div class="education-table">
                <h5>Education:</h5>
                <ul> 
                @foreach ($pairs as $pair)
                <li>{{ $pair[0] }} - {{ $pair[1] }}</li>
                @endforeach
                </ul>
              </div>

              <p>Certificates:</p>
              @foreach($files as $file)
              <div class="mt-3 mb-4">
                <img src="{{ asset('uploads/'. $file) }}" alt="certificates"
                  class="rounded-circle img-fluid" style="width: 100px;" />
              </div>
              @endforeach

             
          </div>
  
        </div>
      </div>
    </div>
  </section>
      
@endsection
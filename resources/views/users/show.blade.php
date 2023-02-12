@extends('layouts.layout')
 
@section('content')

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-12 col-xl-4">
  
          <div class="card" style="border-radius: 15px;">
            <div class="card-body text-center">
              <div class="mt-3 mb-4">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                  class="rounded-circle img-fluid" style="width: 100px;" />
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">Name:</h5>
                <h5 class="mb-2">{{ $user->name }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-2">DOB:</h5>
                <h5 class="mb-2">{{ $user->dob }}</h5>
              </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">Gender:</h5>
                <h5 class="mb-2">{{ $user->gender }}</h5>
              </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">State:</h5>
                <h5 class="mb-2">{{ $user->state_id }}</h5>
              </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">City:</h5>
                <h5 class="mb-2">{{ $user->city_id }}</h5>
              </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">Profession:</h5>
                <h5 class="mb-2">{{ $user->profession }}</h5>
              </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">Email:</h5>
                <h5 class="mb-2">{{ $user->email }}</h5>
              </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">Mobile No:</h5>
                <h5 class="mb-2">{{ $user->mobile_no }}</h5>
              {{-- </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">Skills:</h5>
                <h5 class="mb-2">{{ $user->name }}</h5>
              </div><div class="d-flex justify-content-between">
                <h5 class="mb-2">Education:</h5>
                <h5 class="mb-2">{{ $user->name }}</h5>
              </div> --}}
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </section>
      
@endsection
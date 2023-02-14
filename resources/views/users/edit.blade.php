@extends('layouts.layout')
 
@section('content')

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-12 col-xl-4">
        
            @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('put')
          <div class="card" style="border-radius: 15px;">
            <div class="card-body text-center">
              <div class="mt-3 mb-4">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                  class="rounded-circle img-fluid" style="width: 100px;" />
              </div>

              <div class="form-group mb-3">
                <label for="image">Profile Picture:</label>
                <input type="file" name="image" id="image" class="form-control">
              </div>

              <div class="d-flex justify-content-between mb-3">
                <label for="name">name:</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
              </div>

              <div class="d-flex justify-content-between mb-3" value="{{ old('dob', $user->dob) }}">
                <label for="dob">dob:</label>
                <input type="date" class="form-control" id="dob" name="dob">

              </div>
              
              <div class="d-flex justify-content-between mb-3">
                <span>Gender:</span>
                <input type="radio" name="gender" value="male" id="male">
                <label for="male">male</label>
                <input type="radio" name="gender" value="female" id="female">
                <label for="female">female</label>
              </div>
              
              <div class="d-flex justify-content-between mb-3">
                <label for="state">Choose a state:</label>

                <select name="state" id="state">
                    @foreach ($states as $state)
                      <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>

              </div>
              
              <div class="d-flex justify-content-between mb-3">
                <label for="city">Choose a city:</label>
                <select id="city" name="city"></select>
              </div>
              
              <div class="d-flex justify-content-between mb-3">
                <span>Profession:</span>
                <input type="radio" name="profession" value="1" id="option1">
                <label for="option1">Salaried</label>
                <input type="radio" name="profession" value="2" id="option2">
                <label for="option2">Self-employed</label>
              </div>

              <div id="salaried1" style="display:none;">
              <div class="d-flex justify-content-between mb-3">
                <label for="companyName">company name:</label>
                <input type="text" name="companyName" class="form-control" id="companyName" placeholder="{{ old('dob', $user->company_name) }}">
              </div>

              <div class="d-flex justify-content-between mb-3">
                <label for="doj">Date Of Joining:</label>
                <input type="date" class="form-control" id="doj" name="doj">
              </div>
              </div>

              <div id="self1" style="display:none;">
                <div class="d-flex justify-content-between mb-3">
                  <label for="bussinessName">business name:</label>
                  <input type="text" name="bussinessName" class="form-control" id="bussinessName" placeholder="{{ old('dob', $user->business_name) }}">
                </div>
              
                <div class="d-flex justify-content-between mb-3">
                    <label for="location">location:</label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="{{ old('dob', $user->location) }}">
                </div>
              </div>

              <div class="d-flex justify-content-between mb-3">
                <label for="skills">Skills:</label>

                <select class="js-example-basic-multiple" name="skills[]" multiple="multiple">
                  <option value="java">java</option>
                  <option value="python">python</option>
                  <option value="c++">c++</option>
                  <option value="javascript">javascript</option>
                  <option value="c#">c#</option>
                  <option value="php">php</option>
                  <option value="ruby">ruby</option>
                  <option value="swift">swift</option>
                  <option value="go">go</option>
                  <option value="kotlin">kotlin</option>
                </select>

                </div>

                <div id="education-container">
                    <div class="education-section">
                        <label for="skills">Education:</label>
                      <div class="form-group mb-3">
                        <label for="year">Year:</label>
                        <input type="text" class="form-control" name="year[]">
                      </div>
                      <div class="form-group mb-3">
                        <label for="degree">Degree:</label>
                        <input type="text" class="form-control" name="degree[]">
                      </div>
                    </div>
                </div>
                <button id="add-education-section" type="button" class="btn btn-primary mb-3">Add More</button>

                <div class="form-group">
                  <label for="cert_images">Certificates:</label>
                  <input type="file" name="cert_images[]" id="cert_images" class="form-control mb-3" multiple>
                </div>

              <div class="d-flex justify-content-between mb-3">
                <label for="email">email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
              </div>
              
              <div class="d-flex justify-content-between mb-3">
                <label for="mobile_no">mobile:</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}">
              </div>
              <button type="submit" class="btn btn-primary" id="submit-btn">Update</button>
              
            </div>
            
          </div>
        </form>
        </div>
      </div>
    </div>
  </section>

  <script>
    $(document).ready(function() {
    
    
        $("#state").change(function() {
      var stateId = $(this).val();
    //   alert(stateId);

      // Clear the options in the city dropdown
      $("#city").empty();
        // alert("1");
      // Make an AJAX request to retrieve the cities for the selected state
      $.ajax({
        url: 'http://127.0.0.1:8000/get-cities',
        type: 'GET',
        data: { stateId: stateId },
        success: function(cities) {

            console.log(cities);
          // Loop over the cities and add them to the city dropdown
          cities.forEach(function(city) {
            $("#city").append("<option value='" + city.id + "'>" + city.name + "</option>");
          });
        }
      });
    });

    $("input[name='profession']").change(function() {
            if ($("#option1").is(":checked")) {
                $("#salaried1").show();
                $("#self1").hide();
                $("#bussinessName").val("");
                $("#location").val("");
            }
            if ($("#option2").is(":checked")) {
                $("#self1").show();
                $("#salaried1").hide();
                $("#companyName").val("");
                $("#doj").val("");
            }
    });

    $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    
    
    $('#add-education-section').click(function() {
    $('#education-container').append('<div class="education-section mt-3">\
      <div id="education-section">\
      <div class="form-group">\
        <label for="year">Year:</label>\
        <input type="text" class="form-control" name="year[]">\
      </div>\
      <div class="form-group">\
        <label for="degree">Degree:</label>\
        <input type="text" class="form-control mb-3" name="degree[]">\
      </div>\
      <button id="remove-button" type="button mb-3" class="btn btn-secondary">Remove</button>\
    </div>\
      </div>');
    });

    $('.add').click(function() {
 	    $(this).before('<div class="form-group">\
        <label for="year">Year:</label>\
        <input type="text" class="form-control" name="year[]">\
      </div>\
      <div class="form-group">\
        <label for="degree">Degree:</label>\
        <input type="text" class="form-control" name="degree[]">\
      </div>\
      <button id="remove-button" type="button" class="btn btn-secondary">Remove</button>\
      ');
    });

    $(document).on('click','#remove-button',function() {
 	    $(this).parent('div').remove();
    });
    
  });
  </script>
      
@endsection


@extends('layouts.auth-master')

@section('content')
<style>
    label, .text-center{
        text-align: left !important;
    }

    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
    <form id="RegForm" method="post" action="{{ route('register.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        
        <h1 class="h3 mb-3 fw-normal" style="text-align:center;">Register</h1>

        <div class="form-group form-floating1 mb-3">
            <label for="email"> Email <span class="text-danger">*</span> </label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
            
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group form-floating1 mb-3">
            <label for="password"> Password <span class="text-danger">*</span> </label>
            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating1 mb-3">
            <label for="confirmPassword"> Confirm Password <span class="text-danger">*</span> </label>
            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
            
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <div class="form-group form-floating1 mb-3">
            <label for="firstname"> First Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="Firstname" required="required" autofocus>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('firstname') }}</span>
            @endif
        </div>
        <div class="form-group form-floating1 mb-3">
            <label for="lastname"> Last Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Lastname" required="required" autofocus>
            
            @if ($errors->has('lastname'))
                <span class="text-danger text-left">{{ $errors->first('lastname') }}</span>
            @endif
        </div>
        <div class="form-group  mb-3 " style="text-align:left;">
            <label for="gender"> Gender <span class="text-danger">*</span> </label><br/>
            <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
            <label class="form-check-label" for="male">
              Male
            </label>
            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
            <label class="form-check-label" for="female">
              Female
            </label>
            @if ($errors->has('gender'))
                    <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
            @endif

        </div>
        <div class="form-group  mb-3 " style="text-align:left;">
            <label for="gender"> Country <span class="text-danger">*</span> </label>
            <?php 
            if (!empty($country)) {
                // code...
            
            ?>
              <select  class="form-select" id="country" name="country">
                @foreach($country as $each_country)
                <option value="{{$each_country->countryName}}">{{$each_country->countryName}}</option>
                @endforeach
                <!-- <option value="1">India</option>
                <option value="2">USA</option>
                <option value="3">UAE</option>
                <option value="4">UK</option>
                <option value="5">Oman</option> -->
                
              </select>
          <?php } ?>
        </div>
        <div class="form-group  mb-3 " style="text-align:left;">
            <input class="form-check-input" type="checkbox" value="yes" name="terms" id="terms">
            <label class="form-check-label" for="terms">I agree with terms and conditions  <span class="text-danger">*</span> 
            </label>
        </div>
        <div class="form-group  mb-3 " style="text-align:left;">
            <input class="form-check-input" type="checkbox" value="yes" id="newsletter" name="newsletter">
            <label class="form-check-label" for="newsletter">
              I want to receive the newsletter.
            </label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        
       
    </form>
    <script src="{!! url('assets/bootstrap/js/jquery-3.4.1.min.js') !!}"></script>
    <script src="{!! url('assets/bootstrap/js/jquery.validate.min.js') !!}"></script>
     <script>
        $(document).ready(function() {


            $("#RegForm").validate({
                rules: {
                    firstname: {
                        required: true,
                        maxlength: 20,
                    },
                    lastname:{
                        required: true,
                        maxlength: 20,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },
                    gender: {
                        required: true,
                    },
                    country: {
                        required: true,
                    },

                    
                },
                messages: {
                    firstname: {
                        required: "First name is required",
                        maxlength: "First name cannot be more than 20 characters",
                        
                    },
                    lastname: {
                        required: "Last name is required",
                        maxlength: "Last name cannot be more than 20 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 5 characters"
                    },
                    password_confirmation: {
                        required:  "Confirm password is required",
                        equalTo: "Password and confirm password should same"
                    },
                    gender: {
                        required:  "Please select the gender",
                    },
                    country: {
                        required:  "Please select the country",
                    },
                   
                }
            });
        });
    </script>
@endsection

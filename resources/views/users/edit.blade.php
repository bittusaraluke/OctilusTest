@extends('layouts.app-master')

@section('content')
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
    <div class="bg-light p-5 rounded">
        @auth
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit User</h2>
                    </div>
                    <div class="pull-right" style="text-align: right; margin-bottom: 35px;">
                         <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>


            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                   @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                   @endforeach
                </ul>
              </div>
            @endif


        <form id="editRegForm" action="{{ route('users.update', $user->id) }}" method="POST">
            {{ method_field('PUT') }}

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        

        <div class="form-group form-floating1 mb-3">
            <label for="email"> Email <span class="text-danger">*</span> </label>
                                        
            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="name@example.com" required="required" autofocus>
            <!-- <label for="floatingEmail">Email address </label> -->
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <label for="floatingLastName">Do you want to change the password?</label>  <input class="form-check-input" type="checkbox" value="" name="yes_change_password" id="yes_change_password"  >
        <div id="change_password_holder">
            <div class="form-group form-floating1 mb-3">
                <label for="password"> Password <span class="text-danger">*</span> </label>
                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" >
                
                @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group form-floating1 mb-3">
                <label for="confirmPassword"> Confirm Password <span class="text-danger">*</span> </label>
                <input id="confirmPassword" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" >
                
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group form-floating1 mb-3">
            <label for="firstname"> First Name <span class="text-danger">*</span> </label>
            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" placeholder="Firstname" required="required" autofocus>
            
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('firstname') }}</span>
            @endif
        </div>
        <div class="form-group form-floating1 mb-3">
            <label for="lastname"> Last Name <span class="text-danger">*</span> </label>
            <input id="lastname" ype="text" class="form-control" name="lastname" value="{{ $user->lastname }}" placeholder="Lastname" required="required" autofocus>
            @if ($errors->has('lastname'))
                <span class="text-danger text-left">{{ $errors->first('lastname') }}</span>
            @endif
        </div>
        <div class="form-group  mb-3 " style="text-align:left;">
            <!-- <span>Gender</span> -->
            <label for="gender"> Gender <span class="text-danger">*</span> </label>
            <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($user->gender="male"){ echo "checked";}  ?> >
            <label class="form-check-label" for="male">
              Male
            </label>
            <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($user->gender="female"){ echo "checked";}  ?> >
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
              </select>
              <?php } ?>
        </div>
        <div class="form-group  mb-3 " style="text-align:left;">
            <input class="form-check-input" type="checkbox" value="yes" name="terms" id="terms" <?php if($user->terms="yes"){ echo "checked";}  ?> >
            
            <label class="form-check-label" for="terms">I agree with terms and conditions  <span class="text-danger">*</span> 
            </label>

        </div>
        <div class="form-group  mb-3 " style="text-align:left;">
            <input class="form-check-input" type="checkbox" value="yes" id="newsletter" name="newsletter" <?php if($user->newsletter="yes"){ echo "checked";}  ?>>
            <label class="form-check-label" for="newsletter">
              I want to receive the newsletter.
            </label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        
    </form>

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
    <script src="{!! url('assets/bootstrap/js/jquery-3.4.1.min.js') !!}"></script>
    <script src="{!! url('assets/bootstrap/js/jquery.validate.min.js') !!}"></script>
    <script>
    $(document).ready(function() {
        
            $('#change_password_holder').hide();
            var ckbox = $('#yes_change_password');

        $('input').on('click',function () {
            if (ckbox.is(':checked')) {
                $('#change_password_holder').show();
            } else {
                $('#change_password_holder').hide();
                $('#password').val("");
                $('#password-confirm').val("");
            }
        });
    });
    </script>
    <script>
        $(document).ready(function() {


            $("#editRegForm").validate({
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

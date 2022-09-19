@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Users Management</h2>
                    </div>
                    <div class="pull-right" style="text-align: right; margin-bottom: 35px;">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                    </div>
                </div>
            </div>


            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif


            <table class="table table-bordered">
                <tr>
                   <th>No</th>
                   <th>User Name</th>
                   <th>Email</th>
                   <th>Gender</th>
                   <th>Country</th>
                   <th width="280px">Action</th>
                </tr>
                <?php $slno=0;?>
                @foreach ($data as $key => $user)
                <?php $slno++;?>
                    <tr>
                        <td>{{ $slno }}</td>
                        <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->country }}</td>
                        <td>
                          
                           <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                           <?php if(Auth::user()->id!=$user->id){ ?>
                          <a class="btn btn-danger  mr-2 delete-confirm" href='{{url("/users-delete/{$user->id}")}}'>delete</a>
                           <?php } ?>
<?php 
?>
                           <!-- <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display:inline;">
{{ method_field('DELETE') }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit"   class="btn btn-danger delete-confirm1" value="Delete" onclick="return confirm('Are you sure?')">
                           </form> -->
           
                        </td>
                    </tr>
                @endforeach
            </table>
           
            {!! $data->links('pagination::bootstrap-4') !!}

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
     <script src="{!! url('assets/bootstrap/js/jquery-3.4.1.min.js') !!}"></script>
      <script src="{{ asset('assets/bootstrap/js/sweetalert.min.js') }}"></script><!-- https://unpkg.com/sweetalert/dist/sweetalert.min.js -->
<script>
$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
  </script>

@endsection

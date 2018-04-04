@extends('layouts.app')
  <style type="text/css">
    body
    {
       background-image: url('img/home-bg.jpg');
    }
    p{
      color: #fff;
    }
  </style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: transparent; border:none;">
                <br><br>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                  <form action="" class="search-form" style="margin-top: 30px;">
                      <div class=" col-md-6 col-md-offset-3 form-group has-feedback">
                        <p>Search Friends :</p>
                        <input type="text" class="form-control" autocomplete="off" name="search" id="search" placeholder="eg. Alex">
                      </div>
                      <div class=" col-md-6 col-md-offset-3  form-group has-feedback">
                          <input type="submit" class="form-control btn-success" name="">
                          <p>Note: Only no friend/request user will be shown on query</p>
                      </div>
                  </form>
                  @if($user)
                    <table class="table table-dark" style="background-color: #f5efef;">
                      <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                          </tr>
                      </thead>
                      <tbody>@php $i = 1;@endphp
                        @foreach($user as $key=>$users)
                          <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$users->name}}</td>
                            <td>{{$users->email}}</td>
                            <td><a href="{{ url('/addfriends/'.$users->id)}}">Add friend</a></td>
                          </tr>@php $i++;@endphp
                        @endforeach
                      </tbody>
                    </table>
                  @else
                    <div class="col-md-12">
                      <p style="color: red;">{{$message}}</p>
                    </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

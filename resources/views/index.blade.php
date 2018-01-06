@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Profile</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                  <form action="" class="search-form" style="margin-top: 30px;">
                      <div class=" col-md-6 col-md-offset-3 form-group has-feedback">
                        <label for="search" class="sr-only">Search</label>
                        <input type="text" class="form-control" autocomplete="off" name="search" id="search" placeholder="eg. Alex">
                      </div>
                      <div class=" col-md-6 col-md-offset-3  form-group has-feedback">
                          <input type="submit" class="form-control btn-success" name="">
                      </div>
                  </form>
                  <table class="table table-dark">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($user as $key=>$users)
                                <tr>
                                  <th scope="row">1</th>
                                  <td>{{$users->name}}</td>
                                  <td>{{$users->email}}</td>
                                  <td>View Profile</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

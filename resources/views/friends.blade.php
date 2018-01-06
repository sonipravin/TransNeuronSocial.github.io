@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Friends</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($user))
                      <table class="table table-dark">
                          <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Friend</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $key=>$friend)
                                    <tr>
                                      <th scope="row">1</th>
                                      <td><a href="{{url('/other_profile/'.$friend->id)}}">{{$friend->name}}</a></td>
                                      <td><a href="{{url('/other_profile/'.$friend->id)}}">View Profile</a></td>
                                    </tr>
                                @endforeach
                          </tbody>
                      </table>
                  @else
                    No Friends found
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

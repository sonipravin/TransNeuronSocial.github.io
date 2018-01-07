@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$Otheruser->name}}'s Profile</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  <table class="table table-dark">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Connection</th>
                            </tr>
                          </thead>
                          <tbody>@php $i = 1;@endphp
                            @foreach($OtherSfriend as $key=>$Otherfriend)
                                <tr>
                                  <th scope="row">{{$i}}</th>
                                  <td>
                                    @if($Otherfriend->id == Auth::user()->id)
                                      <a href="{{ route('friends') }}">{{$Otherfriend->name}}</a>
                                    @else
                                      <a href="{{url('/other_profile/'.$Otherfriend->id)}}">{{$Otherfriend->name}}</a>
                                    @endif
                                  </td>
                                  <td>{{$Otherfriend->email}}</td>
                                  <td>
                                    @if(in_array($Otherfriend->id,$myFriend))
                                      Mutual
                                    @endif
                                  </td>
                                </tr>@php $i++;@endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

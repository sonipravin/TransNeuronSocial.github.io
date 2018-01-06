@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pending Request</div>

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
                              <th scope="col">Friend Request</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($pendingRequest as $key=>$request)
                                <tr>
                                  <th scope="row">1</th>
                                  <td>{{$request->name}}</td>
                                  <td><a href="{{url('/acceptRequest/'.$request->id)}}">Accept</a></td>
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

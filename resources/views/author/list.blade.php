@extends('layouts.default')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="form-group">
            <label for="name">WELCOME: {{$userInfo['user']['first_name']}} {{$userInfo['user']['last_name']}}</label>
            <label class="right"><a href="/Main/logout">Logout</a></label>
        </div>
    </div>
    
    <div class="row">
      <div class="col-sm-9 col-md-12 col-lg-12 mx-auto">
        <a href="/Author/addBook/" class="btn btn-info" role="button">Add Book</a>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birth Day</th>
                    <th>Gender</th>
                    <th>Place of Birth</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors['items'] as $author)
                    <tr>
                        <td><a href="/Author/detail/{{ $author['id'] }}">{{ $author['id'] }}</a></td>
                        <td>{{ $author['first_name'] }}</td>
                        <td>{{ $author['last_name'] }}</td>
                        <td>{{ $author['birthday'] }}</td>
                        <td>{{ $author['gender'] }}</td>
                        <td>{{ $author['place_of_birth'] }}</td>
                    </tr>
                @endforeach
                

            </tbody>
        </table>

      </div>
    </div>
</div>
@stop


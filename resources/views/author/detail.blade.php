@extends('layouts.default')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="form-group">
            <label for="name">Author: {{$author['first_name']}} {{$author['last_name']}}</label>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="name">birthday: {{$author['birthday']}}</label>
        </div>
    </div>
    <div class="row">
        <h4>Books: {{count($author['books'])}}</h4>
        <div class="col-md-12 col-lg-12 mx-auto">
        <table class="table table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Description</th>
                    <th>ISBN</th>
                    <th>Format</th>
                    <th>No of Pages</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($author['books'] as $book)
                    <tr>
                        <td>{{ $book['id'] }}</td>
                        <td>{{ $book['title'] }}</td>
                        <td>{{ $book['release_date'] }}</td>
                        <td>{{ $book['description'] }}</td>
                        <td>{{ $book['isbn'] }}</td>
                        <td>{{ $book['format'] }}</td>
                        <td>{{ $book['number_of_pages'] }}</td>
                        <td><a href="/Author/deleteBook/{{ $book['id'] }}_{{ $author['id'] }}">Delete</a></td>
                    </tr>
                @endforeach
                

            </tbody>
        </table>

      </div>
    </div>
</div>
@stop


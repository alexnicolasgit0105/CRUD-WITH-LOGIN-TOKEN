@extends('layouts.default')
@section('content')
    
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-12 col-lg-12 mx-auto">
            @if ($errors->any())
                    <div class="row alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Add Book</h5>
                        <form method="POST" action="">
                            {{ csrf_field() }}
                            <input type="hidden" name="submit" value="1">
                            <div class="form-group">
                            <label for="name">Author</label>
                            <select class="form-control" name="author_id">
                                @foreach($authors['items'] as $author)
                                <option value="{{ $author['id'] }}">{{ $author['first_name'] }} {{ $author['last_name'] }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="title" value="{{old('title')}}">
                          </div>
                            <div class="form-group date" data-provide="datepicker">
                            <label for="name">release_date</label>
                            <input type="text" class="form-control" name="release_date" placeholder="release_date" value="{{old('release_date')}}">
                          </div>
                            <div class="form-group">
                            <label for="name">description</label>
                            <input type="text" class="form-control" name="description" placeholder="description" value="{{old('description')}}">
                          </div>
                          <div class="form-group">
                            <label for="name">isbn</label>
                            <input type="text" class="form-control" name="isbn" placeholder="isbn" value="{{old('isbn')}}">
                          </div>
                            <div class="form-group">
                            <label for="name">format</label>
                            <input type="text" class="form-control" name="format" placeholder="format" value="{{old('format')}}">
                          </div>
                                      <div class="form-group">
                            <label for="name">number_of_pages</label>
                            <input type="text" class="form-control" name="number_of_pages" placeholder="number_of_pages" value="{{old('number_of_pages')}}">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
        </div>
        </div>
      </div>
    </div>
</div>
 <script type="text/javascript">
         $(function () {
            // $('#datetimepicker1').datetimepicker();
         });
      </script>
@stop

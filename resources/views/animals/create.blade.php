@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"> Add new animal </div>
        <div class="card-body">
        
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $err) 
                  <li> {{ $err }} </li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (\Session::has('success'))
            <div class="alert alert-success">
              <p class="mb-0"> {{ \Session::get('success') }} </p>
            </div>
          @endif
          
          <form class="form-horizontal" method="POST"
                action="{{ url('animals') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label> Name: </label>
              <input class="form-control" type="text" name="name" placeholder="Enter name here..."/>
            </div>
            <div class="form-group">
              <label> Date of birth: </label>
              <input class="form-control" type="date" name="DOB"/>
            </div>
            <div class="form-group">
              <label> Description: </label>
              <textarea class="form-control" name="description" maxlength="256"> </textarea>
              <small class="form-text text-muted" id="char_count"></small> 
            </div>
            <div class="form-group">
              <label> Image: </label>
              <input class="form-control-file" type="file" name="image"/>
            </div>
            <div class="form-group mb-0">
              <input type="submit" class="btn btn-primary"/>
              <input type="reset" class="btn btn-primary"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('unique_js')
  <script src="{{ asset('js/edit.js') }}" defer></script>
@endsection







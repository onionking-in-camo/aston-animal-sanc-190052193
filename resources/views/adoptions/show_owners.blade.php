@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"> All owners </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> Ref
                <th> Animal       </th>
                <th> Owner        </th>
                <th> Adopted Date </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($owners as $owner)
              <tr>
                <td class="align-middle"> {{ $owner['id'] }} </td>
                <td class="align-middle"> {{ $owner->animal->name }} </td>
                <td class="align-middle"> {{ $owner->user->name   }} </td>
                <td class="align-middle"> {{ $owner['updated_at']->toFormattedDateString() }} </td>
              <tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
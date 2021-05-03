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
                <th class="sortable pointer"> Ref
                <th class="sortable pointer"> Animal       </th>
                <th class="sortable pointer"> Owner        </th>
                <th class="sortable pointer"> Adopted Date </th>
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
@section('unique_js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  <script src="{{ asset('js/sort_table.js') }}"></script>
@endsection
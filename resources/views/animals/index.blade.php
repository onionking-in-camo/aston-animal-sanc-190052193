@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"> All animals </div>
        <div class="card-body">
          <div id="sort_info"></div>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="sortable pointer"> Name </th>
                <th> D.O.B </th>
                <th class="sortable pointer"> Age </th>
                <th> Description </th>
                <th class="sortable pointer"> Availability </th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($animals as $animal)
              <tr>
                <td class="align-middle"> {{ $animal->name }} </td>
                <td class="align-middle"> {{ $animal->DOBString }} </td>
                <td class="align-middle 
                            text-center"> {{ $animal->age }} </td>
                <td class="align-middle"> {{ $animal->description }} </td>
                <td class="align-middle 
                            text-center"> {{ $animal->status }} </td>
                <td class="align-middle">
                  <a href="{{ route('animals.show', ['animal' => $animal['id']]) }}"
                    class="btn btn-primary">Details</a>
                </td>
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
@section('unique_js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  <script src="{{ asset('js/sort_table.js') }}"></script>
@endsection
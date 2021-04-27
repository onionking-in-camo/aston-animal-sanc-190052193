@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"> All animals </div>
        <div class="card-body">
          <table class="table table-bordered table-striped sortable">
            <thead>
              <tr>
                <th> Name          </th>
                <th> D.O.B           </th>
                <th> Age           </th>
                <th> Description   </th>
                <th> Availability  </th>
                <th> Action        </th>
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

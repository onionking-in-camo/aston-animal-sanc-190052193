@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"> <b>Viewing :: {{ $animal->name }}</b></div>
        <div class="card-body">

          @if (\Session::has('success'))
            <div class="alert alert-success">
              <p class="mb-0"> {{ \Session::get('success') }} </p>
            </div>
          @elseif (\Session::has('failure'))
            <div class="alert alert-info">
              <p class="mb-0"> {{ \Session::get('failure') }} </p>
            </div>
          @endif
          
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th> Name          </th>
                <th> DOB           </th>
                <th> Description   </th>
                <th> Availability  </th>
                <th> Images        </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"> {{ $animal->name         }} </td>
                <td class="text-center"> {{ $animal->DOB          }} </td>
                <td>                     {{ $animal->description  }} </td>
                <td class="text-center"> {{ $animal->status       }} </td>
                <td> 
                  <img class="img-fluid rounded" src="{{ asset('storage/images/' . $animal->image) }}">
                </td>
              </tr>        
            </tbody>
          </table>

          <table>
            <tbody>
              <tr>
                  @if (Auth::check() && Auth::user()->role)
                      <td>
                        <a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}"
                          class="btn btn-warning">Edit</a>
                      </td>
                      <td>
                        <form action="{{ route('animals.destroy', ['animal' => $animal['id']]) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                      </td> 
                  @elseif (Auth::check() && $animal->isAvailable())
                      <td>
                        <form action="{{ route('animals.show', ['animal' => $animal['id']]) }}" method="POST">
                          @csrf
                          <button class="btn btn-primary" type="submit">Adopt</button>
                        </form>
                      </td>
                  @endif
                  <td>
                    <a href="{{ route('animals.index') }}"
                      class="btn btn-primary">Back</a>
                  </td> 
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection

        

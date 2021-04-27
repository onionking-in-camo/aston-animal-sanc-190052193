@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"> My Requests </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> Animal        </th>
                <th> Date Applied  </th>
                <th> Result        </th>
                <th> Actions       </th>
              </tr>
            </thead>

            @if (\Session::has('success'))
              <div class="alert alert-success">
                {{ \Session::get('success') }}
              </div>
            @endif  

            <tbody>
              @foreach ($user_requests as $req)
              <tr>
                <td class="align-middle"> {{ $req->animal->name }} </td>
                <td class="align-middle"> {{ $req['created_at']->toDayDateTimeString() }} </td>
                <td class="align-middle"> {{ $req['status']     }} </td>
                <td class="align-middle"> 
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12">
                          @if ($req->isPending())
                          <form method="POST" 
                            action="{{ route('adoptions.destroy') }}"
                            enctype="multipart/form-data"
                            class="max-width">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $req['id'] }}"/>
                            <input type="submit" class="btn btn-danger w-100" value="Cancel"/>
                          </form>
                          @else
                          <button type="button" class="btn btn-secondary w-100" disabled> No Action </button>
                          @endif
                        </div>
                      </div>
                    </div>
                </td>
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
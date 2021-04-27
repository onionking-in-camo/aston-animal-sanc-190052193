@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"> All adoption requests </div>
        <div class="card-body">
          <table class="table table-bordered table-striped" id="data_table">
            <thead>
              <tr>
                <th> User          </th>
                <th> Animal        </th>
                <th> Date Applied  </th>
                <th> Action        </th>
                <th> Date Actioned </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($all_requests as $req)
              <tr>
                <td class="align-middle"> {{ $req->user->name   }} </td>
                <td class="align-middle"> {{ $req->animal->name }} </td>
                <td class="align-middle"> {{ $req['created_at']->toDayDateTimeString() }} </td>
                <td class="align-middle">
                  @if ($req->isPending())
                    <div class="container">
                      <div class="row">
                        <div class="col-md-6">
                          <form method="POST" 
                            action="{{ route('adoptions.update') }}"
                            enctype="multipart/form-data"
                            class="max-width">
                            @csrf
                            <input type="hidden" name="id" value="{{ $req['id'] }}"/>
                            <input type="hidden" name="action" value="approve"/>
                            <input type="submit" class="btn btn-success w-100" value="Approve"/>
                          </form>
                        </div>
                        <div class="col-md-6">
                          <form method="POST"
                            action="{{ route('adoptions.update') }}"
                            enctype="multipart/form-data"
                            class="max-width">
                            @csrf
                            <input type="hidden" name="id" value="{{ $req['id'] }}"/>
                            <input type="hidden" name="action" value="deny"/>
                            <input type="submit" class="btn btn-danger w-100" value="Deny"/>
                          </form>
                        </div>
                      </div>
                    </div>
                  @else
                    {{ $req['status'] }}
                  @endif
                </td>
                <td class="align-middle">
                  @if ($req->hasUpdated())
                    {{ $req['updated_at']->toDayDateTimeString() }}
                  @endif
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
                  
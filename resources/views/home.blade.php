@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('animals.index') }}">{{ __('List Animals') }}</a>
                        @if (Auth::check())
                            @if (Auth::user()->role)
                                <a class="btn btn-primary" href="{{ route('adoptions.show_owners') }}">{{ __('List Owners') }}</a>
                                <a class="btn btn-primary" href="{{ route('animals.create') }}">{{ __('Add Animal') }}</a>
                                <a class="btn btn-primary" href="{{ route('adoptions.index') }}">{{ __('View Adoption Requests') }}</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('adoptions.show_requests') }}">{{ __('My Requests') }}</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

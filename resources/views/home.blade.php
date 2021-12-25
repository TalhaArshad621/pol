@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                
          <!-- Card with header and footer -->
          <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body pt-4">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                 @endif
                {{ config('app.name') }}
                {{ Auth::user()->email }}
            </div>
            <div class="card-footer">
                {{ __('You are logged in!') }}
            </div>
          </div><!-- End Card with header and footer -->
        </div>
    </div>
</div>
@endsection

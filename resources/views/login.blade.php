@extends('parts.layout')
@section('content')
  <div class="flex items-center justify-end mt-4">
    <a class="btn btn-primary" href="{{ route('login.twitter') }}">
      Login with Twitter
    </a>
  </div>
@endsection

@extends('layouts.app')

@section('content')
    @if (Auth::check())
        @include('gambles.gambles')
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Gambles</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
                {!! link_to_route('login', 'Log in!', [], ['class' => 'btn btn-lg btn-secondary']) !!}
            </div>
        </div>
    @endif
@endsection
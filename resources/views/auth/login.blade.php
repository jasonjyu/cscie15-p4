@extends('layouts.master')

@section('content')
    <p>Don't have an account? <a href='/register' data-ajax='false'>Register here...</a></p>

    <h1>Login</h1>

    {{-- if there are errors, then print them out --}}
    @include('layouts.errors')

    <form method='POST' action='/login' data-transition='none' data-ajax='false'>
        {!! csrf_field() !!}

        <div class='form-group'>
            <label for='email'>Email</label>
            <input type='text' name='email' id='email' value='{{ old('email') }}' autofocus>
        </div>

        <div class='form-group'>
            <label for='password'>Password</label>
            <input type='password' name='password' id='password' value='{{ old('password') }}'>
        </div>

        <div class='form-group'>
            <input type='checkbox' name='remember' id='remember'>
            <label for='remember' class='checkboxLabel'>Remember me</label>
        </div>

        <button type='submit' class='btn btn-primary'>Login</button>
    </form>
@stop

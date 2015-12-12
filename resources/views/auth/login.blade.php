@extends('layouts.master')

@section('content')
    <p>Don't have an account? <a href='/register' data-ajax='false'>Register here...</a></p>

    <h1>Login</h1>

    {{-- if there are errors, then print them out --}}
    @include('layouts.errors')

    <form method='POST' action='/login' data-transition='none' data-ajax='false'>
        {!! csrf_field() !!}

        <div class='form-group'>
            <label for='email' class='ui-hidden-accessible'>Email</label>
            <input id='email' type='text' name='email' value='{{ old('email') }}' placeholder='Email' autofocus/>
        </div>

        <div class='form-group'>
            <label for='password' class='ui-hidden-accessible'>Password</label>
            <input id='password'  type='password' name='password'value='{{ old('password') }}' placeholder='Password'/>
        </div>

        <div class='form-group'>
            <input id='remember' type='checkbox' name='remember'>
            <label for='remember' class='checkboxLabel'>Keep me logged in</label>
        </div>

        <button type='submit' class='btn btn-primary'>Login</button>
    </form>
@stop

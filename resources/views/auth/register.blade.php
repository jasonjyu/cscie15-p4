@extends('layouts.master')

@section('content')
    <br/>
    <p>Already have an account? <a href='/login'>Login here...</a></p>

    <h1>Register</h1>

    <form method='POST' action='/register'>
        {!! csrf_field() !!}

        <div class='form-group'>
            <input id='name' type='text' name='name' value='{{ old('name') }}' placeholder='Name' autofocus/>
        </div>

        <div class='form-group'>
            <input id='email' type='text' name='email' value='{{ old('email') }}' placeholder='Email'/>
        </div>

        <div class='form-group'>
            <input id='password' type='password' name='password' placeholder='Password (min 6 characters)'/>
        </div>

        <div class='form-group'>
            <input id='password_confirmation' type='password' name='password_confirmation' placeholder='Confirm Password'/>
        </div>

        <button type='submit' class='btn btn-primary'>Register</button>
    </form>

    {{-- if there are errors, then print them out --}}
    @include('layouts.errors')
@stop

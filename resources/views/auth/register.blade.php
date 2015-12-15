@extends('layouts.master')

@section('content')
    <br/>
    <p>Already have an account? <a href='/login' data-ajax='false'>Login here...</a></p>

    <h1>Register</h1>

    <form method='POST' action='/register' data-transition='none' data-ajax='false'>
        {!! csrf_field() !!}

        <div class='form-group'>
            <label for='name' class='ui-hidden-accessible'>Name</label>
            <input id='name' type='text' name='name' value='{{ old('name') }}' placeholder='Name' autofocus/>
        </div>

        <div class='form-group'>
            <label for='email' class='ui-hidden-accessible'>Email</label>
            <input id='email' type='text' name='email' value='{{ old('email') }}' placeholder='Email'/>
        </div>

        <div class='form-group'>
            <label for='password' class='ui-hidden-accessible'>Password</label>
            <input id='password' type='password' name='password' placeholder='Password (min 6 characters)'/>
        </div>

        <div class='form-group'>
            <label for='password_confirmation' class='ui-hidden-accessible'>Confirm Password</label>
            <input id='password_confirmation' type='password' name='password_confirmation' placeholder='Confirm Password'/>
        </div>

        <button type='submit' class='btn btn-primary'>Register</button>
    </form>

    {{-- if there are errors, then print them out --}}
    @include('layouts.errors')
@stop

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where should the user be redirected to if their login succeeds?
     */
    protected $redirectPath = '/search';

    /**
     * Where should the user be redirected to if their login fails?
     */
    protected $loginPath = '/login';

    /**
     * Where should the user be redirected to after logging out?
     */
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        // logout user
        \Auth::logout();

        // indicate user is logged out
        \Session::flash('flash_message', 'You have been logged out.');

        // delete all data from the global session
        \Session::flush();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        \Auth::login($this->create($request->all()));

        // save the hashtag terms stored in the global session to the database
        $this->saveStoredHashtags();

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated($request, $user)
    {
        // save the hashtag terms stored in the global session to the database
        $this->saveStoredHashtags();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Saves the hashtag terms stored in the global session to the database.
     */
    protected function saveStoredHashtags()
    {
        // get the user id logged in
        $user_id = \Auth::id();

        // create a hashtag associated with the user if it does not exist
        // for each stored hashtag term in global session
        $stored_terms = \Session::pull('stored_terms', []);
        while (($term = array_pop($stored_terms)) != null) {
            \App\Hashtag::firstOrCreate(compact('term', 'user_id'));
        }
    }
}

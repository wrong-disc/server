<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller {

    public function register(Request $request) {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $this->guard()->login($user);

        return response()->json([
            'user' => $user,
            'message' => 'Registration successful'
        ], 200);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }
    
    public function index(Request $request){
        Gate::authorize('list-user');
        return User::where("id","!=",$request->user()->id)->get();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function guard() {
        return Auth::guard();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login successful'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }

    public function update(Request $request, User $user) {
        Gate::authorize('edit-user');
        $data =[
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];
        if($request->password != null){
           $data ["password"] = Hash::make($request->password);
        }
        return $user->update($data);
    }

    public function show(User $user){
        Gate::authorize('view-user');
        return $user;
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete-user');
        foreach($user->tracks as $track){
            $track->pivot->delete();
        }
        $user->delete();
    }   
}

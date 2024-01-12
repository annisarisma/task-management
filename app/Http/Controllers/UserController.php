<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register_index()
    {
        return view('authentication.register', [
            'title' => 'Register'
        ]);
    }

    public function register_store(Request $request)
    {
        try {
            // Validation data
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', Password::min(8)],
                'confirm_password' => ['required']
            ]);

            // Checking password and confirmation password
            if ($request['password'] != $request['confirm_password']) {
                return back()->withErrors([
                    'confirm_password' => ["Confirmation password doesn't match"]
                ])->withInput();
            }
        
            // User Create
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Return
            return redirect('/login')->with('success-alert', [
                'message' => $request->username . ' successfulliy created'
            ]);
        } catch (Exception $error) {
            return redirect('/register');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login_index()
    {
        return view('authentication.login', [
            'title' => 'Login'
        ]);
    }

    public function login_store(Request $request)
    {
        $remember = $request->has('remember') ? true : false;
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/project')->with('success-alert', [
                'message' => $request->username . ' successfully login'
            ]);
        }

        // if not succeed
        return back()->withErrors([
            'password' => ["Username or password doesn't match"]
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

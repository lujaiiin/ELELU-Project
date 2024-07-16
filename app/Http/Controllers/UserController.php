<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Using bcrypt for hashing
        ]);
    
        // Optionally, send a welcome email or perform other actions
    
        return response()->json(['message' => 'User registered successfully'], 201);
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }
    
        $request->session()->regenerate();
    
        return response()->json(['message' => 'Logged in successfully'], 200);
    }
}

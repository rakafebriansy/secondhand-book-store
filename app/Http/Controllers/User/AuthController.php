<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('user.pages.login',[
            'title' => 'Login'
        ]);
    }
    public function doLogin(LoginUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        try {
            $isAuthenticated = auth('web')->attempt([
                'email' => $data['email'], 
                'password' => $data['password']
            ]);
            if($isAuthenticated) {
                return redirect('/')->with('success', 'Login success');
            }
            return back()->withInput()->withErrors(['errors' => 'Invalid credentials']);
        } catch(\Exception $error) {
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
    public function register(): View
    {
        return view('user.pages.register',[
            'title' => 'Register'
        ]);
    }
    public function doRegister(RegisterUserRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $user = new User($data);
            $user->password = Hash::make($data['password']);
            if($user->save()) {
                return redirect('/login')->with('success', 'Registration success');
            }
            return back()->withInput()->withErrors(['errors' => 'Registration failed']);
        } catch (\Exception $error) {
            Log::error('Registration error: ' . $error->getMessage());
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('admin.pages.login',[
            'title' => 'Admin | Login'
        ]);
    }
    public function doLogin(LoginAdminRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $isAuthenticated = auth('admin')->attempt([
                'username' => $data['username'], 
                'password' => $data['password']
            ]);
            if($isAuthenticated) {
                return redirect('/admin/product')->with('success', 'Login success');
            }
            return back()->withInput()->withErrors(['errors' => 'Invalid credentials']);
        } catch(\Exception $error) {
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
}

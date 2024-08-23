<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use Auth;
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
        $data = $request->validated();
        try {
            $isAuthenticated = auth('admin')->attempt([
                'username' => $data['username'], 
                'password' => $data['password']
            ]);
            if($isAuthenticated) {
                $request->session()->regenerate();
                return redirect('/admin/product')->with('success', 'Login success');
            }
            return back()->withInput()->withErrors(['errors' => 'Invalid credentials']);
        } catch(\Exception $error) {
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin')->with('success', 'Logout success');;
    }
}

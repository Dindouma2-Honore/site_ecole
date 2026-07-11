<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprenantAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('apprenant')->check()) {
            return redirect()->route('espace-apprenant.dashboard');
        }

        return view('site.espace-apprenant.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'matricule' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $apprenant = Apprenant::where('matricule', $credentials['matricule'])->first();

        if (!$apprenant || !Auth::guard('apprenant')->attempt(
            ['matricule' => $credentials['matricule'], 'password' => $credentials['password']]
        )) {
            return back()
                ->withErrors(['matricule' => "Matricule ou mot de passe incorrect."])
                ->onlyInput('matricule');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('espace-apprenant.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::guard('apprenant')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

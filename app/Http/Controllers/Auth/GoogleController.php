<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        if (Auth::check() && !Auth::user()->isConvidat()) {
            return redirect()->route('home')
                ->with('error', 'Només els usuaris convidats poden autenticar-se amb Google.');
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Si l'usuari ja està autenticat i no és convidat, no permetre l'accés
            if (Auth::check() && !Auth::user()->isConvidat()) {
                return redirect()->route('home')
                    ->with('error', 'Només els usuaris convidats poden autenticar-se amb Google.');
            }

            // Buscar o crear l'usuari
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Si l'usuari existeix però no és convidat, no permetre l'accés
                if (!$user->isConvidat()) {
                    return redirect()->route('login')
                        ->with('error', 'Aquest compte de correu ja està registrat com a usuari regular.');
                }
            } else {
                // Crear nou usuari convidat
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'role' => 'convidat',
                ]);
            }

            Auth::login($user);

            return redirect()->route('home')
                ->with('success', 'Has iniciat sessió correctament com a convidat.');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Hi ha hagut un error en l\'autenticació amb Google.');
        }
    }
}

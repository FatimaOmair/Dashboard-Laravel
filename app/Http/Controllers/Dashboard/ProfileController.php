<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $countries = Countries::getNames();
        $locales = Locales::getNames();

        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => $countries,
            'locales' => $locales,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthdate' => 'nullable|before:today|date',
            'gender' => ['in:male,female'],
            'country' => 'required|string|size:2',
            'local' => 'required|string|size:2',
        ]);

        $user = $request->user();

        // Ensure profile exists before updating
        if (!$user->profile) {
            $user->profile()->create($request->all());
        } else {
            $user->profile->fill($request->all())->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}


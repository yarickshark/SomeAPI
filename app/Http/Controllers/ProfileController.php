<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard(Request $request)
    {
        $collections = Collections::all();
        $coll = [];

        foreach ($collections as $collection) {
            $cont = Contributors::where('collection_id', $collection->id)->sum('amount');
            $coll[] = [
                'collection' => $collection,
                'cont' => $cont,
            ];
        }

        // Преобразование массива в коллекцию
        $collCollection = collect($coll);

        // Фильтрация
        $filterValue = $request->input('filter_value', null);

        if (!is_null($filterValue)) {
            $collCollection = $collCollection->where('cont', $filterValue);
        }

        // Сортировка
        $sortBy = $request->input('sort_by', 'asc');

        $collCollection = $collCollection->sortBy('cont', SORT_REGULAR, $sortBy === 'desc');

        // Преобразование коллекции обратно в массив
        $coll = $collCollection->all();

        return view('dashboard', ['coll' => $coll]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

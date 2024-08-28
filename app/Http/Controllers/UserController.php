<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prefixname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'photo' => 'nullable|image',
        ]);


        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }


        User::create([
            'prefixname' => $validated['prefixname'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'photo' => $validated['photo'] ?? null,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'prefixname' => 'nullable|in:Mr,Mrs,Ms',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffixname' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|max:2048',
            'type' => 'required|string|in:user,admin',
        ]);

        $user->fill($request->only([
            'prefixname',
            'firstname',
            'middlename',
            'lastname',
            'suffixname',
            'username',
            'email',
            'type'
        ]));

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($user->photo);
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->get();
        return view('users.trashed', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.trashed')->with('success', 'User restored successfully.');
    }

    public function delete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        Storage::disk('public')->delete($user->photo);
        $user->forceDelete();
        return redirect()->route('users.trashed')->with('success', 'User permanently deleted.');
    }
}

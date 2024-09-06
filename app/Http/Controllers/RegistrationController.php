<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('user.list', compact('users', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirmed',
            ],
        ], [
            'password.regex' => 'The password must contain both letters and numbers.',
        ]);

        // Create a new user
        $user = User::create([
            'name' => trim($validatedData['name']),
            'email' => trim($validatedData['email']),
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
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
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'password' => [
                'nullable',  // Password is optional when updating
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirmed',
            ],
        ], [
            'password.regex' => 'The password must contain both letters and numbers.',
        ]);

        // Update the user data
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = isset($validatedData['password']) ? Hash::make($validatedData['password']) : $user->password; // Only update password if it's provided
        $user->save();
        // Redirect or return response
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}

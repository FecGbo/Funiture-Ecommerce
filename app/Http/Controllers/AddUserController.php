<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AddUserController extends Controller
{
    //
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255 ',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,customer',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $users = new User();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = bcrypt($request->input('password'));
        $users->role = $request->input('role');
        $users->address = $request->input('address');
        $users->phone = $request->input('phone');
        $users->dob = $request->input('dob');
        if ($request->hasFile('image')) {
            $users->image = $request->file('image')->store('users', 'public');
        } else {
            $users->image = null; // or set a default image path
        }
        $users->save();
        session()->flash('new_user_id', $users->id);
        return redirect()->route('user.list')->with('success', 'User registered successfully!');




    }
    public function listUsers()
    {
        $allowedSorts = ['name', 'email', 'role', 'address', 'phone', 'dob'];
        $allowedDirs = ['asc', 'desc'];
        $sort = request('sort', 'id');
        $dir = request('dir', 'desc');
        if (!in_array($sort, $allowedSorts))
            $sort = 'id';
        if (!in_array($dir, $allowedDirs))
            $dir = 'desc';

        $users = User::orderBy($sort, $dir)->paginate(6);
        return view('add_user.list', compact('users'));

    }
}

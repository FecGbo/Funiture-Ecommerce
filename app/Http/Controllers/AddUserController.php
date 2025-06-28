<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
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

    public function inlineUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $field = $request->input('field');
        $value = $request->input('value');

        if (!in_array($field, ['name', 'email', 'role', 'address', 'phone'])) {
            return response()->json(['success' => false, 'message' => 'Invalid field.']);
        }

        $user->$field = $value;
        $user->save();
        return response()->json(['success' => true]);

    }
    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view('add_user.detail', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|in:admin,customer',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password') ? bcrypt($request->input('password')) : $user->password;
        $user->role = $request->input('role');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');

        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('users', 'public');
        }

        $user->save();
        return redirect()->route('user.list')->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.list')->with('success', 'User deleted successfully!');
    }
    public function getCustomer()
    {
        $customers = DB::table('users')
            ->where('role', 'customer')
            ->get();

        return view('add_user.customerList', compact('customers'));
    }
}

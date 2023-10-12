<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        return view("user.index");
    }

    public function store(Request $request)
    {
        if($request->id){
            $request->validate([
                'name' => 'required|min:3|max:50',
                'username' => 'required|min:3|max:20',
                'role' => 'required',
            ]);

           $user = User::findOrFail($request->id);
           $user->update([
            'name' => $request->name, 
            'username' => $request->username,
            'role' => $request->role,
           ]);
           
           return response()->json(['message'=>'User updated successfully.']);
        }

        $request->validate([
            'name' => 'required|min:3|max:50',
            'username' => 'required|min:3|max:20|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);

        User::Create([
            'name' => $request->name, 
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ]);        

        return response()->json(['message'=>'User saved successfully.']);
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
      
        return response()->json(['message'=>'User deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // ✅ Import Hash

class UserController extends Controller
{
    use ApiResponser;

    public function getUsers()
    {
        $users = User::all();
        return $this->successResponse($users, "Users retrieved successfully", 200);
    }

    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
        ];
        $this->validate($request, $rules);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password); // ✅ Use Hash::make()

        $user = User::create($userData);
        return $this->successResponse($user, "User created successfully", 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse("User not found", 404);
        }
        return $this->successResponse($user, "User found", 200);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
        ];
        $this->validate($request, $rules);

        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse("User not found", 404);
        }

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]); // ✅ Use Hash::make()
        }

        $user->update($request->all());
        return $this->successResponse($user, "User updated successfully", 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse("User not found", 404);
        }

        $user->delete();
        return $this->successResponse(null, "User deleted successfully", 200);
    }
}

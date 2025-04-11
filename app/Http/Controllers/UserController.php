<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    use ApiResponser;

    public function index()
    {
        return $this->successResponse(['message' => 'UserController is working!'], 200);
    }

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
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ];

        $this->validate($request, $rules);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);

        if (!isset($userData['name'])) {
            $userData['name'] = "Unnamed";
        }

        if (!isset($userData['email'])) {
            $userData['email'] = "noemail@example.com";
        }

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
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->fill($request->all());

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
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

    public function getUser()
    {
        $user = ['name' => 'Jane Doe', 'email' => 'jane@example.com'];
        return $this->successResponse($user);
    }

    public function getError()
    {
        return $this->errorResponse('User not found', 404);
    }

    public function goToDashboard()
    {
        return redirect('/dashboard');
    }
}
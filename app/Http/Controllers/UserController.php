<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // ✅ Import Hash
use Illuminate\Http\Response; // Add this if you use Response class

/*class UserController extends Controller {
    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }

    public function add(Request $request) {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
        ];
        $this->validate($request, $rules);
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id) {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
        ];
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->fill($request->all());

        if ($user->isClean()) {
            return response()->json(['error' => 'At least one value must change'], 422);
        }

        $user->save();
        return response()->json($user);
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}*/


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
        $user = User::findOrFail($id);
        return $this->successResponse($user);
        
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
        $user = User::findOrFail($id);

        $user->fill($request->all());

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);

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
        $user = User::findOrFail($id);
        $user->delete();
        return $this->errorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);
        
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse("User not found", 404);
        }

        $user->delete();
        return $this->successResponse(null, "User deleted successfully", 200);
    }
    
    public function addUser(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
        ];
        $this->validate($request, $rules);
        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }
}

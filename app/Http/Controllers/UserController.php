<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller {
    use ApiResponser;
    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }

    public function add(Request $request) {
=======
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
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
<<<<<<< HEAD
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
=======
            'name' => 'nullable|string|max:255', // Ensure name is optional
            'email' => 'nullable|email|max:255', // Ensure email is optional
        ];
        $this->validate($request, $rules);
    
        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);
    
        // Provide a default name if not set
        if (!isset($userData['name'])) {
            $userData['name'] = "Unnamed"; 
        }
    
        // Provide a default email if not set
        if (!isset($userData['email'])) {
            $userData['email'] = "noemail@example.com"; 
        }
    
        // ✅ Now create the user outside of the condition
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
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
        ];
        $this->validate($request, $rules);
<<<<<<< HEAD
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
    
    public function getUser(){
        $user = ['name' => 'Jane Doe', 'email' => 'jane@example.com'];
        return $this->successResponse($user); // ✅ use trait method
    }

    public function getError(){
        return $this->errorResponse('User not found', 404); // ✅ use trait method
=======

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

    public function goToDashboard()
    {
    return redirect('/dashboard');
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
    }
}

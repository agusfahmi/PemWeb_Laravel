<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function __construct() {
        // $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);


        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' => $validator->errors()->toArray()
            ], 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'message' => 'User has been created!',
            'user' => $user
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|Int|max:20',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'status' => 'Validation Error'
            ]);
        }

        $user = User::where('id', $request->input('id'), 100)->update(array('name' => $request->input('name'), 'password' => $request->input('password')));
        if ($user != null) {
        } else {
            return response([
                'message' => 'No data found!',
            ], 403);
        }

        return response()->json([
            'message' => 'user has been created!',
            'user' => $user
        ]);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|Int|max:20',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'status' => 'Validation Error'
            ]);
        }
        $user = User::find($request->input('id'),);
        if ($user != null) {
            $user->delete();
            return response(['message' => 'user has been deleted!']);
        } else {
            return response([
                'message' => 'No data found!',
            ], 403);
        }
    }
    public function show()
    {
        $user = User::all();
        return response([
            'total' => $user->count(),
            'messages' => 'Retrieved successfuly',
            'data' => UserResource::collection($user)
        ], 200);
    }

    public function show1($id)
    {
        $user = User::find($id);
        if ($user != null) {
            return response([
                'data' => new UserResource($user),
                'message' => 'Retrieved Successfully'
            ], 200);
        } else {
            return response([
                'message' => 'No data found!'
            ], 403);
        }
    }
}
?>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        /*if ($token = $this->guard('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }//
        if ($token = auth()->guard('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }*/
	
	 /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
	
	public function login(Request $request){
		$this->validateLogin($request);
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'errors' => [
                    'account' => [
                        "Invalid email or password"
                    ]
                ]
            ], 422);
        }
        return $this->respondWithToken($token);	
	}
	 /**
     * Get a JWT token for registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request,[
			'name' => 'required',
			'email' => 'required|unique:users,email',
			'password' => 'required|min:6'
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password)
		]);

		// Get the token
		$token = auth('api')->login($user);
		return $this->respondWithToken($token);

    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard('api')->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        //$this->guard('api')->logout();
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => $this->guard('api')->factory()->getTTL() * 60
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
	
	/**
	*
	* Update User Profile
	*
	*/
	public function profile(Request $request){
	
		//return response()->json(['message' => 'Working good']);
		$user = auth('api')->user();
		
		
		$this->validate($request,[
			'name' => 'required',
			'email' => "required|unique:users,email, $user->id",
			'password' => 'sometimes|nullable|min:4'
		]);
		//return response()->json(['info' => $user]);
		
		$user->update([
			'name' => $request->name,
			'email' => $request->email		
		]);
		
		if($request->password){
			$user->update([
				'password' => bcrypt($request->password)
			]);
		}
		
		return response()->json([
			'success' => true,
			'user' => $user
		], 200);
		
	}
}

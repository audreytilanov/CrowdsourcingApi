<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function login(Request $request){

        $credentials = $request->only(['email', 'password']);

        if(!$token = Auth::guard('admin')->attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => "Invalid Credentials"

            ]);
        }else{
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => Auth::guard('admin')->user()
            ]);
        }

    }

    public function register(Request $request){
        $pass = Hash::make($request->password);
        // dd($request);
        try{
            Pegawai::create([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'password' => $pass
            ]);
            return $this->login($request);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function logout(Request $request){
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => "Logout Success"

            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }
}

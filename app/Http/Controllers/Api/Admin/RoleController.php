<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        try{
            $data = Role::all();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function edit($id){
        try{
            $data = Role::find($id);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
        
    }

    public function store(Request $request){
        try{
            Role::create([
                'role' => $request->role,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Role Created"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function update($id, Request $request){

        try{
            $kategoriId = Role::find($id);

            $kategoriId->update([
                'role' => $request->role,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Role Updated",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function delete($id){

        try{
            $kategoriId = Role::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Role Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

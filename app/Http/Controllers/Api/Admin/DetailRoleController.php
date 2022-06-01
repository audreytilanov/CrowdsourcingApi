<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\DetailRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailRoleController extends Controller
{
    public function index(){
        try{
            $data = DetailRole::all();

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
            $data = DetailRole::find($id);

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
            DetailRole::create([
                'role_id' => $request->role_id,
                'pegawai_id' => $request->pegawai_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Detail Role Created"
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
            $kategoriId = DetailRole::find($id);

            $kategoriId->update([
                'role_id' => $request->role_id,
                'pegawai_id' => $request->pegawai_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Detail Role Updated",
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
            $kategoriId = DetailRole::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Detail Role Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

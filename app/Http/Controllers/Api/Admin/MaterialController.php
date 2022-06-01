<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    public function index(){
        try{
            $data = Material::all();

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
            $data = Material::find($id);

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
            Material::create([
                'detail' => $request->detail,
                'link' => $request->link,
                'detail_transaksi_id' => $request->detail_transaksi_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Material Created"
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
            $kategoriId = Material::find($id);

            $kategoriId->update([
                'detail' => $request->detail,
                'link' => $request->link,
                'detail_transaksi_id' => $request->detail_transaksi_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Material Updated",
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
            $kategoriId = Material::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Material Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

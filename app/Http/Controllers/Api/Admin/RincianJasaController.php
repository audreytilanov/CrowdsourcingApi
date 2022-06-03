<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\RincianJasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RincianJasaController extends Controller
{
    public function index(){
        try{
            $data = RincianJasa::all();

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
            $data = RincianJasa::find($id);

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
            RincianJasa::create([
                'jasa_id' => $request->jasa_id,
                'nama' => $request->nama,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Rincian Jasa Created"
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
            $kategoriId = RincianJasa::find($id);

            $kategoriId->update([
                'nama' => $request->nama,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Rincian Jasa Updated",
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
            $kategoriId = RincianJasa::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Rincian Jasa Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

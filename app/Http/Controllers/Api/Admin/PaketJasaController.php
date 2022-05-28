<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\PaketJasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaketJasaController extends Controller
{
    public function index(){
        $data = PaketJasa::all();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request){
        try{
            PaketJasa::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Paket Jasa Created"
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
            $kategoriId = PaketJasa::find($id);

            $kategoriId->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Paket Jasa Updated",
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
            $kategoriId = PaketJasa::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Paket Jasa Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

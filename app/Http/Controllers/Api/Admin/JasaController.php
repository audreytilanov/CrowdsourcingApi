<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Jasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JasaController extends Controller
{
    public function index(){
        try{
            $data = Jasa::with(['paketjasas', 'kategoris'])->get();

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
            $data = Jasa::with(['paketjasas', 'kategoris'])->find($id);

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
            Jasa::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'paket_jasa_id' => $request->paket_jasa_id,
                'kategori_id' => $request->kategori_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Jasa Created"
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
            $kategoriId = Jasa::find($id);

            $kategoriId->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'paket_jasa_id' => $request->paket_jasa_id,
                'kategori_id' => $request->kategori_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Jasa Updated",
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
            $kategoriId = Jasa::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Jasa Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

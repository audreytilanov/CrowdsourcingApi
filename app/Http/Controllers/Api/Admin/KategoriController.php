<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index(){
        $data = Kategori::all();

        return response()->json([
            'success' => true,
            'user' => $data
        ]);
    }

    public function store(Request $request){
        try{
            // Kategori::create([
            //     'nama' => $request->nama,
            //     'deskripsi' => $request->deskripsi,
            // ]);
            return response()->json([
                'success' => true,
                'message' => "Kategori Created"
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
            $kategoriId = Kategori::find($id);

            $kategoriId->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Kategori Updated",
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
            $kategoriId = Kategori::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Kategori Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

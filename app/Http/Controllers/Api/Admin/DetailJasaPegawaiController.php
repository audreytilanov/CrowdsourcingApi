<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailJasa;
use App\Models\RincianJasa;

class DetailJasaPegawaiController extends Controller
{

    public function rincianjasaindex(){
        try{
            $data = RincianJasa::with(['detailjasapegawais' => function ($query) {
                $query->with(['skills', 'rincianjasas', 'pegawais']);
            }])->get();

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

    public function index($id){
        try{
            $data = DetailJasa::with(['skills', 'pegawais', 'rincianjasas'])->where('rincian_jasa_id', $id)->get();
            
            if(!empty(RincianJasa::find($id))){
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'data' => "Data tidak ditemukan"
                ]); 
            }
            
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function edit($id){
        try{
            $data = DetailJasa::find($id);

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

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

    public function store(Request $request){
        try{
            DetailJasa::create([
                'skill_id' => $request->skill_id,
                'rincian_jasa_id' => $request->rincian_jasa_id,
                'pegawai_id' => $request->pegawai_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Detail Jasa Pegawai Created"
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
            $kategoriId = DetailJasa::find($id);

            $kategoriId->update([
                'skill_id' => $request->skill_id,
                'rincian_jasa_id' => $request->rincian_jasa_id,
                'pegawai_id' => $request->pegawai_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Detail Jasa Pegawai Updated",
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
            $kategoriId = DetailJasa::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Detail Jasa Pegawai Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

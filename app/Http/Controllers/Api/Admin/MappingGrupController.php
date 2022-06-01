<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MappingGrup;

class MappingGrupController extends Controller
{
    public function index(){
        try{
            $data = Transaksi::with('mappinggrups')->orderBy('created_at', 'DESC')->get();
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => "No Data Found"
            ]);
        }
    }

    public function detail($id){
        try{
            $data = Transaksi::with('mappinggrups')->find($id);
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => "No Data Found"
            ]);
        }
    }

    public function store($id, Request $request){
        try{
            $data = MappingGrup::create([
                'pegawai_id' => $request->pegawai_id,
                'transaksi_id' => $id,
                'nama' => $request->nama
            ]);
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => "No Data Found"
            ]);
        }
    }

    public function update($id, Request $request){
        try{
            $data = MappingGrup::find($id);
            $data->update([
                'pegawai_id' => $request->pegawai_id,
                'transaksi_id' => $id,
                'nama' => $request->nama
            ]);
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => "No Data Found"
            ]);
        }
    }

    public function delete($id){

        try{
            $kategoriId = MappingGrup::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Mapping Grup Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

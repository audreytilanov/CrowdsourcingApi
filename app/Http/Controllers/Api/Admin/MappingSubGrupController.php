<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\MappingGrup;
use Illuminate\Http\Request;
use App\Models\MappingSubGrup;
use App\Http\Controllers\Controller;

class MappingSubGrupController extends Controller
{
    public function index($id){
        try{
            $data = MappingGrup::with(['transaksis', 'pegawais', 'mappingsubgrups'])->where('id', $id)->first();
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
            $data = MappingSubGrup::with(['transaksis', 'mappinggrups', 'detailtransaksis'])->find($id);
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
            $check = MappingGrup::with(['transaksis', 'pegawais', 'mappingsubgrups'])->where('id', $id)->first();
            $data = MappingSubGrup::create([
                'mapping_grup_id' => $check->id,
                'transaksi_id' => $check->transaksi_id,
                'detail_transaksi_id' => $request->detail_transaksi_id,
                'nama' => $request->nama
            ]);
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

    public function update($id, Request $request){
        try{
            $data = MappingSubGrup::find($id);

            $data->update([
                'detail_transaksi_id' => $request->detail_transaksi_id,
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
            $kategoriId = MappingSubGrup::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Mapping Sub Grup Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

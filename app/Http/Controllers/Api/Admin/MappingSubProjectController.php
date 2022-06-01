<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\MappingSubGrup;
use App\Http\Controllers\Controller;
use App\Models\MappingSubProject;

class MappingSubProjectController extends Controller
{
    public function index($id){
        try{
            $data = MappingSubGrup::with(['mappinggrups', 'transaksis', 'detailtransaksis'])->where('id', $id)->first();
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
            $data = MappingSubProject::with(['mappingsubgrups', 'rincianjasas', 'pegawai_id'])->find($id);
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
            $check = MappingSubGrup::with(['mappinggrups', 'transaksis', 'detailtransaksis'])->where('id', $id)->first();
            $data = MappingSubProject::create([
                'mapping_sub_grup_id' => $check->id,
                'rincian_jasa_id' => $request->rincian_jasa_id,
                'pegawai_id' => $request->pegawai_id,
                'persentasi_gaji' => $request->persentasi_gaji,
                'sub_project' => $request->sub_project,
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
            $data = MappingSubProject::find($id);

            $data->update([
                'rincian_jasa_id' => $request->rincian_jasa_id,
                'pegawai_id' => $request->pegawai_id,
                'persentasi_gaji' => $request->persentasi_gaji,
                'sub_project' => $request->sub_project,
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
            $kategoriId = MappingSubProject::find($id);

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

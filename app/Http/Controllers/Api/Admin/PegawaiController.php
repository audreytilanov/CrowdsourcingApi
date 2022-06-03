<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailRole;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index(){
        try{
            $data = Pegawai::with('detailroles')->get();

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
            $data = Pegawai::with('detailroles')->find($id);

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
            $pegawai = Pegawai::create([
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'password' =>  Hash::make($request->password),
            ]);

            DetailRole::create([
                'pegawai_id' => $pegawai->id,
                'role_id' => $request->role_id
            ]);
            return response()->json([
                'success' => true,
                'message' => "Pegawai Created"
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
            $kategoriId = Pegawai::with('detailroles')->find($id);
            $detailRole = DetailRole::where('pegawai_id', $kategoriId->id)->first();

            $kategoriId->update([
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'password' =>  Hash::make($request->password)
            ]);
            
            $detailRole->update([
                'role_id' =>$request->role_id
            ]); 

            return response()->json([
                'success' => true,
                'message' => "Pegawai Updated",
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
            $detailRole = DetailRole::where('pegawai_id', $id)->first();
            $kategoriId = Pegawai::find($id);

            $detailRole->delete();
            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Pegawai Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

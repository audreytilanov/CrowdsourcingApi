<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function index(){
        $data = Skill::all();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request){
        try{
            Skill::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Skill Created"
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
            $kategoriId = Skill::find($id);

            $kategoriId->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return response()->json([
                'success' => true,
                'message' => "Skill Updated",
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
            $kategoriId = Skill::find($id);

            $kategoriId->delete();
            return response()->json([
                'success' => true,
                'message' => "Skill Deleted"
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
}

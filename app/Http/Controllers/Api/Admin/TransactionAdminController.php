<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionAdminController extends Controller
{
    public function index(){
        try{
            $data = Transaksi::with(['users', 'pegawais', 'kategoris', 'detailtransaksis'=> function ($query) {
                $query->with('materials', 'jasas');
            }])->orderBy('created_at', 'DESC')->get();

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

    public function statusProgress($id){
        try{
            $data = Transaksi::find($id);

            $data->update([
                'status' => "in progress"
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

    public function statusFinish($id){
        try{
            $data = Transaksi::find($id);

            $data->update([
                'status' => "finish"
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
}

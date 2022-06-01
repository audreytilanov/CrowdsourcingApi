<?php

namespace App\Http\Controllers\Api\User;

use Exception;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        try{
            $data = Transaksi::with(['users', 'pegawais', 'kategoris'])->where('user_id', Auth::guard('api')->user()->id)->get();

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

    public function detail($id){
        try{
            $check = Transaksi::find($id);
            if($check->user_id != Auth::guard('api')->user()->id){
                return response()->json([
                    'success' => false,
                    'message' => "You have no access to this data"
                ]);
            }else{
                $data = Transaksi::find($id)->with(['users', 'pegawais', 'kategoris'])->where('user_id', Auth::guard('api')->user()->id)->get();
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function buktiPembayaran($id){
        
    }
    
}

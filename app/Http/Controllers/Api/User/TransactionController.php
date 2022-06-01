<?php

namespace App\Http\Controllers\Api\User;

use Exception;
use App\Models\Jasa;
use App\Models\Material;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DetailPayment;
use App\Models\DetailTransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index(){
        try{
            $data = Transaksi::with(['users', 'pegawais', 'kategoris', 'detailtransaksis'=> function ($query) {
                $query->with('materials', 'jasas');
            }])->where('user_id', Auth::guard('api')->user()->id)->get();

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
                $data = Transaksi::find($id)->with(['users', 'pegawais', 'kategoris', 'detailtransaksis'=> function ($query) {
                    $query->with('materials', 'jasas');
                }])->where('user_id', Auth::guard('api')->user()->id)->first();
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => "No Data Found"
            ]);
        }
    }

    public function buktiPembayaran($id, Request $request){
        try{
            $check = Transaksi::find($id);
            if($check->user_id != Auth::guard('api')->user()->id){
                return response()->json([
                    'success' => false,
                    'message' => "You have no access to this data"
                ]);
            }else{
                if($request->file('image')){
                    // Storage::disk('asset')->delete('admin/product/'.$data->image_name);
                    $checkPop = DetailPayment::where('transaksi_id', $id)->first();
                    if(!$checkPop == true){
                        $filename = Str::random(10).$request->image->getClientOriginalName();
                        $file = $request->file('image');
                        Storage::disk('asset')->put('buktipembayaran/'.$filename, file_get_contents($file));
    
                        DetailPayment::create([
                            'transaksi_id' => $id,
                            'type' => $filename,
                        ]);

                        $transaksiUpdateStatus = Transaksi::find($id);
                        $transaksiUpdateStatus->update([
                            'status' => "pending"
                        ]);
                        return response()->json([
                            'success' => true,
                            'message' => "Proof of Payment Uploaded!"
                        ]);
                    }else{
                        return response()->json([
                            'success' => false,
                            'message' => "Proof of Payment already exist!"
                        ]);
                    }
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => "There's an error when uploading data"
                    ]);
                }
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function create(Request $request){
        $datas=json_decode($request->getContent(), true);
        // return response()->json($datas[0]['id']);
        // dd($datas->id[0]);
        // $data = [1,2];
        try{
            $data = Transaksi::create([
                'nama' => $datas['nama'],
                'user_id' => Auth::guard('api')->user()->id,
                'kategori_id' => $datas['kategori_id'],
                'status' => "Waiting for Payment",
            ]);
            $totalHarga = array();
            foreach ($datas['detail'] as $key => $value) {
                $jasaId = Jasa::find($value['jasa_id']);
                $detail = DetailTransaksi::create([
                    'transaksi_id' => $data->id,
                    'jasa_id' => $value['jasa_id'],
                    'qty' => $value['qty'], 
                    'harga_total' => $jasaId->harga * $value['qty'],
                    'status' => "progress"
                ]);
                if(!empty($value['detail']) && !empty($value['link'])){
                    Material::create([
                        "detail" => $value['detail'],
                        "link" => $value['link'],
                        "detail_transaksi_id" => $detail->id,
                    ]);
                }
                array_push($totalHarga, $jasaId->harga * $value['qty']);
            }
            $updateTransaksi = Transaksi::find($data->id);
            $hargaTotal = array_sum($totalHarga);
            $updateTransaksi->update([
                'jumlah_harga' => $hargaTotal
            ]); 
            $getLastTransaction = Transaksi::with('detailtransaksis')->where('id', $data->id)->get();
            return response()->json([
                'success' => true,
                'data' => $getLastTransaction
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }
    
}

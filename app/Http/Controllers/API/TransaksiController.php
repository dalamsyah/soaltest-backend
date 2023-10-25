<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiHeader;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use Log;
use DB;

class TransaksiController extends Controller
{

    public function index()
    {
        //get posts
        $data = TransaksiHeader::all();

        return response()->json([
            "success" => true,
            "message" => "Transaksi Header",
            "data" => $data
        ]);
    }

    //
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $data = json_decode($request->get('details'), true);

            $header = TransaksiHeader::create([
                'nomortransaksi' => $request->get('nomortransaksi'),
                'jenistransaksi' => $request->get('jenistransaksi')
            ]);

            foreach($data as $key=>$value) {
    
                $detail = TransaksiDetail::create([
                    'idbarang' => $value['id'],
                    'idtransaksi' => $header->id,
                    'jumlahbarang' => $value['jumlahbarang']
                ]);

                $barang = Barang::find($value['id']);
                $qty = $barang->stokbarang;

                if ($request->get('jenistransaksi') == "masuk") {
                    $qty += $value['jumlahbarang'];
                } else {
                    $qty -= $value['jumlahbarang'];
                }

                $barang->update([
                    'stokbarang' => $qty
                ]);

            }

            DB::commit();

            return response()->json([
                'data' => [],
                'message' => 'Post created successfully.',
                'success' => true
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e);

            return response()->json([
                'data' => [],
                'message' => 'Created failed.',
                'success' => true
            ]);
        }

    }
}

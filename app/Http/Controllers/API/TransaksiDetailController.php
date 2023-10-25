<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiHeader;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use Log;
use DB;

class TransaksiDetailController extends Controller
{
    //
    public function show($id)
    {
        //get posts
        $data = TransaksiDetail::where('idtransaksi', $id)->get();

        $r = array();
        foreach ($data as $p) {

            $barang = Barang::find($p->idbarang);

            $p->barang = $barang;
            // $d = [
            //     "detail" => $p,
            //     "barang" => $barang
            // ];

            array_push($r, $p);
        }

        return response()->json([
            "success" => true,
            "message" => "Transaksi Detail Header",
            "data" => $r
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Barang;
use Log;
use DB;

class BarangController extends Controller
{
    //
    public function index()
    {
        //get posts
        $data = Barang::all();

        return response()->json([
            "success" => true,
            "message" => "Master Barang",
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {

        $data = Barang::create([
            'kodebarang' => $request->get('kodebarang'),
            'namabarang' => $request->get('namabarang'),
            'stokbarang' => $request->get('stokbarang')
        ]);

        // $data = Barang::find($store->id);

        return response()->json([
            'data' => [
                $data
            ],
            'message' => 'Post created successfully.',
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $data = Barang::find($id);
        $data->delete();
        return response()->json([
            'data' => [],
            'message' => 'Deleted successfully',
            'success' => true
        ]);
    }

    public function update(Request $request, $id)
    {

        $data = Barang::find($id);

        $data->update([
            'kodebarang' => $request->get('kodebarang'),
            'namabarang' => $request->get('namabarang'),
            'stokbarang' => $request->get('stokbarang')
        ]);

        return response()->json([
            'data' => [
                $data
            ],
            'message' => 'Updated successfully',
            'success' => true
        ]);
    }

}

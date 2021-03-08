<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buy;
use App\Models\Supplier;

class BuyController extends Controller
{

  public function index(Request $request)
  {
    try {
      $buy = Buy::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'buy Succes',
        'data' => $buy, 200
      ]);
    } catch (\Throwable $th) {

      return response()->json([
        'Status' => 'error',
        'Message' => $th,
        'data' => Null, 402,
      ]);
    }
  }

  public function create(Request $request)
  {
    try {
      $buy = Buy::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'buy Berhasil Di Tampilkan',
        'data' => $buy, 200
      ]);
    } catch (\Throwable $th) {

      return response()->json([
        'Status' => 'error',
        'Message' => $th,
        'data' => Null, 402,
      ]);
    }
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'phone_supplier' => 'required|string|max:255',
      'barang' => 'required|string|max:255',
      'tbarang' => 'required|numeric|min:1',
      // 'tbayar' => 'required|numeric|min:1',
      'harga' => 'required',
    ]);

    $buy = new Buy();

    $noHp = $request->phone_supplier;
    $suple = Supplier::where('phone_number', $noHp)->first();
    $buy->supplier = $suple->name;
    $buy->supplier_id = $suple->id;

    $buy->harga_barang = $request->harga;
    $buy->barang = $request->barang;
    $buy->tbarang = $request->tbarang;
    $buy->tbayar = $buy->tbarang * $buy->harga_barang;

    try {
      $buy->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'buy Succes',
        'data' => $buy, 200
      ]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'Status' => 'error',
        'Message' => $th,
        'data' => Null, 402,
      ]);
    }
  }

  public function edit($id)
  {
    try {
      $buy = Buy::get($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'buy berhasil ditampilkan',
        'data' => $buy, 200
      ]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'Status' => 'error',
        'Message' => $th,
        'data' => Null, 402,
      ]);
    }
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, []);

    $buy = Buy::find($id);
    $dataRequest = $request->all();
    $dataResult = array_filter($dataRequest);

    try {
      $buy->update($dataResult);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'buy Berhasil Di Update',
        'data' => $buy, 200
      ]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'Status' => 'error',
        'Message' => $th,
        'data' => Null, 402,
      ]);
    }
  }

  public function delete($id)
  {
    try {
      $buy = Buy::destroy($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'buy Berhasil Di Hapus',
        'data' => $buy, 200
      ]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'Status' => 'error',
        'Message' => $th,
        'data' => Null, 402,
      ]);
    }
  }
}

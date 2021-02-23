<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{

  public function index(Request $request)
  {
    try {
      $barang = Barang::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'barang Succes',
        'data' => $barang, 200
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
      $barang = Barang::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'barang Berhasil Di Tampilkan',
        'data' => $barang, 200
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
      'name' => 'required|string|max:255',
      'uid' => 'required',
      'hb' => 'required',
      // 'hj' => 'required',
      'merek' => 'required',
      'stok' => 'required',
      'kategori' => 'required',
      'diskon' => 'required'
    ]);

    $barang = new Barang;
    $barang->name = $request->name;
    $barang->uid = $request->uid;
    $barang->hb = $request->hb;
    $barang->hj = $request->hj;
    $barang->merek = $request->merek;
    $barang->stok = $request->stok;
    $barang->diskon = $request->diskon;
    $listKategori = $request->kategori;
    $kategori = Kategori::where('id', $listKategori)->first();
    $barang->kategori = $kategori;

    try {
      $barang->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'barang Succes',
        'data' => $barang, 200
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
      $barang = Barang::get($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'barang berhasil ditampilkan',
        'data' => $barang, 200
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

    $barang = Barang::find($id);
    $dataRequest = $request->all();
    $dataResult = array_filter($dataRequest);

    try {
      $barang->update($dataResult);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'barang Berhasil Di Update',
        'data' => $barang, 200
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
      $barang = Barang::destroy($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'barang Berhasil Di Hapus',
        'Delete ID' => $id,
        'data' => $barang, 200
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Buy;
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
      // 'hb' => 'required',
      // 'hj' => 'required',
      // 'stok' => 'required',
      'merek' => 'required',
      'kategori' => 'required',
      'diskon' => 'required'
    ]);

    $barang = new Barang;

    $name_barang = $request->name;
    $nameBarang = Buy::where('name', $name_barang)->first();
    $barang->name = $nameBarang->name;
    $barang->hb = $nameBarang->tbayar / $nameBarang->tbarang;
    $barang->stok = $nameBarang->tbarang;
    $barang->avatar = $request->avatar;

    $barang->uid = $request->uid;
    $barang->hj = $barang->hb * 10;
    $barang->merek = $request->merek;
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

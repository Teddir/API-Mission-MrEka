<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
  public function index(Request $request)
  {
    try {
      $kategori = kategori::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'kategori Succes',
        'data' => $kategori, 200
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
      $kategori = kategori::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'kategori Berhasil Di Tampilkan',
        'data' => $kategori, 200
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
    ]);

    $kategori = new kategori();
    $kategori->name = $request->name;

    try {
      $kategori->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'kategori Succes',
        'data' => $kategori, 200
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
      $kategori = kategori::get($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'kategori berhasil ditampilkan',
        'data' => $kategori, 200
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

    $kategori = kategori::find($id);
    $dataRequest = $request->all();
    $dataResult = array_filter($dataRequest);

    try {
      $kategori->update($dataResult);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'kategori Berhasil Di Update',
        'data' => $kategori, 200
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
      $kategori = kategori::destroy($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'kategori Berhasil Di Hapus',
        'data' => $kategori, 200
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

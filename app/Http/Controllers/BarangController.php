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
      // 'uid' => 'required',
      // 'hb' => 'required',
      'hj' => 'required',
      // 'stok' => 'required',
      // 'merek' => 'required',
      // 'kategori' => 'required',
      // 'diskon' => 'required',
      // 'avatar' => 'required'
    ]);

    $barang = new Barang;

    $name_barang = $request->name;
    $nameBarang = Buy::where('barang', $name_barang)->first();
    $barang->buy_id = $nameBarang->id;
    $barang->name = $nameBarang->barang;
    $barang->hb = $nameBarang->tbayar / $nameBarang->tbarang;
    $barang->stok = $nameBarang->tbarang;


    $barang->uid = $request->uid;
    $barang->hj = $barang->hb * 10;
    $barang->merek = $request->merek;
    $barang->diskon = $request->diskon;

    $listKategori = $request->kategori;
    $kategori = Kategori::where('id', $listKategori)->first();
    if ($kategori) {
      # code...
      $barang->kategori = $kategori->name;
      $barang->kategori_id = $kategori->id;
    }

    $avatar = $request->file('avatar');
    if ($avatar) {
      # code...
      $avatar = $request->file('avatar');
      $file = base64_encode(file_get_contents($avatar));
      $client = new \GuzzleHttp\Client();
      $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
        'form_params' => [
          'key' => '6d207e02198a847aa98d0a2a901485a5',
          'action' => 'upload',
          'source' => $file,
          'format' => 'json'
        ]
      ]);

      $data = $response->getBody()->getContents();
      $data = json_decode($data);
      $image = $data->image->url;
      $barang->avatar = $image;
    } else
      $barang->avatar = 'https://via.placeholder.com/150';
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
    $dataRequest = $request->except(['avatar']);
    $dataResult = array_filter($dataRequest);
    $avatar = $request->file('avatar');
    if ($avatar) {
      # code...
      $file = base64_encode(file_get_contents($avatar));

      $client = new \GuzzleHttp\Client();
      $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
        'form_params' => [
          'key' => '6d207e02198a847aa98d0a2a901485a5',
          'action' => 'upload',
          'source' => $file,
          'format' => 'json'
        ]
      ]);

      $data = $response->getBody()->getContents();
      $data = json_decode($data);
      $image = $data->image->url;

      $barang->avatar = $image;
    } else
      $avatar = $request->avatar;

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

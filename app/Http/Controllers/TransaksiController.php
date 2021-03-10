<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\User;
use App\Models\Barang;

class TransaksiController extends Controller
{

  public function index(Request $request)
  {
    try {
      $transaksi = Transaksi::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'transaksi Succes',
        'data' => $transaksi, 200
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
      $transaksi = Transaksi::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'transaksi Berhasil Di Tampilkan',
        'data' => $transaksi, 200
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
      // 'barang' => 'required|string|max:255',
      'jb' => 'required|numeric|min:1',
      // 'ht' => 'required|numeric|min:1',
      'pay' => 'required|numeric|min:1',
      // 'change' => 'required|numeric|min:1',
      // 'kode_member' => 'required|numeric|min:1',
      // 'pin_kasir' => 'required|string|min:1',
      // 'diskon' => 'required|numeric|min:1',
      // 'name_barang' => 'required',
    ]);

    $transaksi = new Transaksi();

    $name = $request->name_barang;
    if ($name) {
      $nameBarang = Barang::where('name', $name)->first();
      $transaksi->barang = $nameBarang->name;

      $jumlahBarang = $request->jb;
      $bayar = $request->pay;
      $totalHarga = $nameBarang->hj * $jumlahBarang;
      if ($bayar < $totalHarga) {
        # code...
        return response()->json([
          'status' => 'Failed',
          'message' => 'Maaf uang anda kurang',
          'total_harga' => $totalHarga,
        ]);
      } else {
        # code...
        $transaksi->jb = $jumlahBarang;
        $transaksi->pay = $bayar;
        $transaksi->diskon = $nameBarang->diskon;
        $transaksi->barang_id = $nameBarang->id;

        if ($nameBarang->stok < $jumlahBarang) {
          # code...
          return response()->json([
            'status' => 'Failed',
            'message' => 'Maaf stok kami tidak cukup',
            'Sisa_Stok' => $nameBarang->stok,
          ]);
        } else {
          $updateStokBarang = $nameBarang->stok - $jumlahBarang;
          $nameBarang->stok = $updateStokBarang;
          $nameBarang->update();
        };
      }
    }

    $barcode = $request->barcode_barang;
    if ($barcode) {
      $barcodeBarang = Barang::where('uid', $barcode)->first();
      $transaksi->barang = $barcodeBarang->name;

      $jumlahBarang = $request->jb;
      $bayar = $request->pay;
      $totalHarga = $barcodeBarang->hj * $jumlahBarang;
      if ($bayar < $totalHarga) {
        # code...
        return response()->json([
          'status' => 'Failed',
          'message' => 'Maaf uang anda kurang',
          'total_harga' => $totalHarga,
        ]);
      } else {
        # code...
        $transaksi->jb = $jumlahBarang;
        $transaksi->pay = $bayar;
        $transaksi->diskon = $barcodeBarang->diskon;
        $transaksi->barang_id = $barcodeBarang->id;

        if ($barcodeBarang->stok < $jumlahBarang) {
          # code...
          return response()->json([
            'status' => 'Failed',
            'message' => 'Maaf stok kami tidak cukup',
            'Sisa_Stok' => $barcodeBarang->stok,
          ]);
        } else {
          $updateStokBarang = $barcodeBarang->stok - $jumlahBarang;
          $barcodeBarang->stok = $updateStokBarang;
          $barcodeBarang->update();
        };
      }
    }


    $transaksi->ht = $transaksi->pay / $transaksi->diskon;
    $transaksi->change = $transaksi->pay - $transaksi->ht;

    $kode = $request->kode_member;
    if ($kode) {
      # code...
      $kodeMember  = User::where('password', $kode)->first();
      $transaksi->kode_member = $kodeMember;
      $transaksi->member_id = $kodeMember->id;
    }

    $pinKasir = User::where('id', auth()->user()->id)->first();
    $transaksi->pin_kasir = $pinKasir->password;
    $transaksi->kasir_id = $pinKasir->id;

    try {
      $transaksi->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'transaksi Succes',
        'data' => $transaksi, 200
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
      $transaksi = Transaksi::get($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'transaksi berhasil ditampilkan',
        'data' => $transaksi, 200
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

    $transaksi = Transaksi::find($id);
    $dataRequest = $request->all();
    $dataResult = array_filter($dataRequest);

    try {
      $transaksi->update($dataResult);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'transaksi Berhasil Di Update',
        'data' => $transaksi, 200
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
      $transaksi = Transaksi::destroy($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'transaksi Berhasil Di Hapus',
        'data' => $transaksi, 200
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

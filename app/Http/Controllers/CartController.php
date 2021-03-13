<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{

  public function index(Request $request)
  {
    $cart = Cart::with('barangs')->get();
    try {
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'cart Succes',
        'data' => $cart, 200
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
      $cart = Cart::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'cart Berhasil Di Tampilkan',
        'data' => $cart, 200
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
    $this->Validate($request, [
      // 'barang' => 'required',
      // 'qty' => 'required|numeric|min:1',
      // 'subtotal' => 'required|numeric|min:1'
    ]);

    $cart = new Cart();
    $nameBarang = $request->barang;
    $barangKu = Barang::where('name', $nameBarang)->first();
    $cart->barang_id = $barangKu->id;
    $cart->barang = $barangKu->name;
    $cart->barcode = $barangKu->uid;
    // dd($cart->barang);
    if (Cart::get()->count() > 0) {
      # code...
      if ($cart->barcode != null) {
        # code...
        $countBarang = Cart::where('barcode', $cart->barcode)->count();
      } else {
        $countBarang = Cart::where('barang', $cart->barang)->count();
      }
      $cart->qty = $countBarang + 1;
      if ($cart->qty > 1) {
        # code...
        // $cart->qty = $countBarang;
        // dd($cart->qty);
        $cart->subtotal = ($cart->qty * $barangKu->hj) / $barangKu->diskon;
      } else {
        $cart->subtotal = ($cart->qty * $barangKu->hj) / $barangKu->diskon;
      }

      try {
        $cart->save();
        //code...
        return response()->json([
          'Status' => 'Sucess',
          'Message' => 'buy Succes',
          'data' => $cart, 200
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

    $cart->qty = 1;
    $cart->subtotal = ($cart->qty * $barangKu->hj) / $barangKu->diskon;
    try {
      $cart->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'buy Succes',
        'data' => $cart, 200
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
      $cart = Cart::get($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'cart berhasil ditampilkan',
        'data' => $cart, 200
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

    $cart = Cart::find($id);
    $dataRequest = $request->all();
    $dataResult = array_filter($dataRequest);

    try {
      $cart->update($dataResult);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'cart Berhasil Di Update',
        'data' => $cart, 200
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
      $cart = Cart::destroy($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'cart Berhasil Di Hapus',
        'data' => $cart, 200
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

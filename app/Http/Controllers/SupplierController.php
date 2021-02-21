<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{

  public function index(Request $request)
  {
    try {
      $supplier = Supplier::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'Supplier Succes',
        'data' => $supplier, 200
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
      $supplier = Supplier::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'Supplier Berhasil Di Tampilkan',
        'data' => $supplier, 200
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
        'alamat' => 'required|string|max:255',
        'phone_number' => 'required|numeric|min:11',
    ]);

    $supplier = new Supplier();
    $supplier->name = $request->name;

    try {
      $supplier->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'Supplier Succes',
        'data' => $supplier, 200
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
      $supplier = Supplier::get($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'Supplier berhasil ditampilkan',
        'data' => $supplier, 200
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
    $this->validate($request,[
      
    ]);

    $supplier = Supplier::find($id);
    $dataRequest = $request->all();
    $dataResult = array_filter($dataRequest);

    try {
      $supplier->update($dataResult);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'Supplier Berhasil Di Update',
        'data' => $supplier, 200
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
      $supplier = Supplier::destroy($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'Supplier Berhasil Di Hapus',
        'data' => $supplier, 200
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{

  public function index(Request $request)
  {
    try {
      $expense = Expense::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'expense Succes',
        'data' => $expense, 200
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
      $expense = Expense::get();

      return response()->json([
        'Status' => 'Succes',
        'Message' => 'expense Berhasil Di Tampilkan',
        'data' => $expense, 200
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
      'expense' => 'required|numeric',
    ]);

    $expenses = new Expense;
    $expenses->name = $request->name;
    $expenses->expense = $request->expense;
    $sum = Expense::get()->sum('expense');
    $expenses->total = $expenses->expense + $sum;

    try {
      $expenses->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'expense Succes',
        'data' => $expenses, 200
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
      $expense = Expense::get($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'expense berhasil ditampilkan',
        'data' => $expense, 200
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

    $data = Expense::find($id);
    $dataName = $request->name;
    if ($dataName) {
      # code...
      $data->name = $dataName;
    } else {
      $data->name = $data->name;
    }

    $dataExpense = $request->expense;
    if ($dataExpense) {
      # code...
      $data->expense = $dataExpense;
    } else {
      $data->expense = $data->expense;
    }

    $sum = Expense::get()->sum('expense');
    $data->total = $sum + $data->expense; 

    try {
      $data->update();
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'expense Berhasil Di Update',
        'data' => $data, 200
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
    $expensesAll = Expense::get()->last();
    $expe = Expense::find($id);
    $expensesAll->total = $expensesAll->total - $expe->expense;
    try {
      $expe = Expense::destroy($id);
      $expensesAll->save();
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'expense Berhasil Di Hapus',
        'Delete ID' => $id,
        'data' => $expe, 200
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

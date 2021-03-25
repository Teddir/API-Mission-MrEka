<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{

  public function index()
  {
    try {
      $project = Project::get();
      return response([
        'status' => 'succes',
        'message' => 'Berhasil Di update',
        'data' => $project, 200
      ]);
    } catch (\Throwable $th) {
      return response([
        'status' => 'error',
        'message' => $th->getMessage(),
        'data' => NULL, 404
      ]);
    }
  }

  public function store(Request  $request)
  {
    $this->validate($request, [
      'title' => 'required|string|max:255',
      'avatar' => 'required',
    ]);

    $project = new Project();

    $project->title = $request->title;
    $project->desc = $request->desc;

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
      $project->avatar = $image;
    } else
      $project->avatar = 'https://via.placeholder.com/150';
    try {
      $project->save();
      //code...
      return response()->json([
        'Status' => 'Sucess',
        'Message' => 'project Succes',
        'data' => $project, 200
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

    $project = Project::find($id);
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

      $project->avatar = $image;
    } else
      $avatar = $request->avatar;

    try {
      $project->update($dataResult);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'project Berhasil Di Update',
        'data' => $project, 200
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
      $project = Project::destroy($id);
      //code...
      return response()->json([
        'Status' => 'Succes',
        'Message' => 'project Berhasil Di Hapus',
        'Delete ID' => $id,
        'data' => $project, 200
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request->email)->first();
        $token1 =  $this->respondWithToken($token);
        return response()->json(compact('user', 'token1'));
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'phone_number' => 'required|numeric|min:11',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone_number' => $request->get('phone_number'),
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token1 = $this->respondWithToken($token);
        return response()->json(compact('user', 'token1'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
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

            $user->avatar = $image;
        } else
            $avatar = $request->avatar;
        try {
            $user->update($dataResult);
        } catch (\Throwable $th) {
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
        }
        return response([
            'status' => 'succes',
            'message' => 'Berhasil Di update',
            'data' => $user, 200
        ]);
    }

    public function getAllUser()
    {
        try {
            $user = User::get();

            return response([
                'status' => 'succes',
                'message' => 'Berhasil Menampilkan Semua User',
                'data' => $user, 200
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
        }
    }

    public function getOneUser()
    {
        try {
            $user = User::where('id', auth()->user()->id)->get();
            //code...
            return response([
                'status' => 'succes',
                'message' => 'Berhasil Menampilkan 1 User',
                'data' => $user, 200
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
        }
    }

    public function getRoleUser($id)
    {
        try {
            $user = User::where('role', $id)->get();
            //code...
            return response([
                'status' => 'succes',
                'message' => 'Berhasil Menampilkan 1 User',
                'data' => $user, 200
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => NULL, 404
            ]);
        }
    }

    public function registerKasir(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'pin_kasir' => 'required|numeric|min:6',
            'umur' => 'required|numeric|min:2',
            'alamat' => 'required|string|max:225',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        // $user = User::create([
        //     'name' => $request->get('name'),
        //     'email' => $request->get('email'),
        //     'pin_kasir' => Hash::make($request->get('pin_kasir')),
        //     'umur' => $request->get('umur'),
        //     'alamat' => $request->get('alamat'),
        //     'role' => 2,
        // ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->pin_kasir = $request->pin_kasir;
        $user->umur = $request->umur;
        $user->alamat = $request->alamat;
        $user->role = 2;

        try {
            $user->save();
            //code...
            return response()->json([
                'status' => 'Succes',
                'message' => 'Berhasil mendaftarkan kasir',
                'data' => $user,
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => 'Error',
                'message' => $th,
                'data' => null,
            ], 201);
        }
    }

    public function loginKasir(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|numeric',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}

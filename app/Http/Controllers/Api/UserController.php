<?php

namespace App\Http\Controllers\Api;

use App\Models\Penduduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class UserController extends Controller
{
    public function createUser(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8', // Pastikan tidak ada batasan maksimal yang terlalu pendek
            'role' => 'required|in:penduduk,admin,petugas',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'user' => $user
        ], 201);
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to create user',
            'error' => $th->getMessage()
        ], 500);
    }
}

    

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 422);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = Penduduk::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updateUserPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Penduduk::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update password',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }

            Penduduk::where('email', $user->email)->update([
                'nama_lengkap' => $request->nama_lengkap,
                'username' => $request->username,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kebangsaan' => $request->kebangsaan,
                'pekerjaan' => $request->pekerjaan,
                'status_nikah' => $request->status_nikah,
                'nik' => $request->nik,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User data updated successfully',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user data',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function getUserFromToken()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama_lengkap' => $user->nama_lengkap,
                'username' => $user->username,
                'email' => $user->email,
                'no_hp' => $user->no_hp,
                'alamat' => $user->alamat,
                'jenis_kelamin' => $user->jenis_kelamin,
                'tanggal_lahir' => $user->tanggal_lahir,
                'kebangsaan' => $user->kebangsaan,
                'pekerjaan' => $user->pekerjaan,
                'status_nikah' => $user->status_nikah,
                'nik' => $user->nik,
            ]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}

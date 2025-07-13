<?php

namespace App\Services\Petugas;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Petugas\PetugasServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class PetugasService implements PetugasServiceInterface
{
    public function storePetugas (Request $request) : void
    {
        User::create([
            'name'              => $request->username,
            'email'             => $request->email,
            'nama_petugas'      => $request->nama_petugas,
            'email_verified_at' => now(),
            'password'          => bcrypt($request->password),
        ]);
    }

    public function showPetugas (User $user) : JsonResponse
    {
        if (!$user) {
            return response()->json(null, 404);
        }

        return response()->json([
            'username'          => $user->name,
            'email'             => $user->email,
            'nama_petugas'      => $user->nama_petugas,
            'created_at'        => $user->created_at_format,
            'updated_at'        => $user->updated_at_format
        ], 200);
    }

    public function destroyPetugas (User $user) : void
    {
        $user->delete();
    }
}

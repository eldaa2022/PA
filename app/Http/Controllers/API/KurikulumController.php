<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Http\Resources\ResponseResource;


class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurikulum = Kurikulum::latest()->paginate(5);
        return new ResponseResource(true,'list data kurikulum', $kurikulum);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profil_lulusan' => 'required',
            'deskripsi' => 'required',
            'kemampuan' => 'required',
            'status' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kurikulum = Kurikulum::create([
            'profil_lulusan' => $request-> profil_lulusan,
            'deskripsi' => $request-> deskripsi,
            'kemampuan' => $request-> kemampuan,
            'status' => $request-> status,
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $kurikulum);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kurikulum = Kurikulum::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $kurikulum);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profil_lulusan' => 'required',
            'deskripsi' => 'required',
            'kemampuan' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $kurikulum = Kurikulum::whereId($request->input('id'))->update([
                'profil_lulusan' => $request-> input('profil_lulusan'),
                'deskripsi' => $request-> input('deskripsi'),
                'kemampuan' => $request-> input('kemampuan'),
                'status' => $request-> input('status'),
            ]);

            if ($kurikulum) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $kurikulum);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

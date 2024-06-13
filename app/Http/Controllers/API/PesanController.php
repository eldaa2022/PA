<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Http\Resources\ResponseResource;


class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesan = Pesan::latest()->paginate(5);
        return new ResponseResource(true,'list data pesan', $pesan);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'isi_pesan' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pesan = Pesan::create([
            'email' => $request-> email,
            'isi_pesan' => $request-> isi_pesan,
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $pesan);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesan = Pesan::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $pesan);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'isi_pesan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $pesan = Pesan::whereId($request->input('id'))->update([
                'email' => $request-> input('email'),
                'isi_pesan' => $request-> input('isi_pesan'),
            ]);

            if ($pesan) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $pesan);
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

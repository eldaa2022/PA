<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Http\Resources\ResponseResource;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::latest()->paginate(5);
        return new ResponseResource(true,'list data kontak', $dosen);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'foto' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048',
            'kompetensi' => 'required',
            'matkul' => 'required',
            'lampiran' => 'required', // Ini untuk kasi tau lulusan mana
            'status' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $foto->storeAs('public/gambar', $foto->hashName());

        $dosen = Dosen::create([
            'nama' => $request-> nama,
            'email' => $request-> email,
            'foto' => $foto-> hashName(),
            'kompetensi' => $request-> kompetensi,
            'matkul' => $request-> matkul,
            'lampiran' => $request-> lampiran,
            'status' => $request-> status,
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $dosen);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dosen = Dosen::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $dosen);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'foto' => 'required',
            'kompetensi' => 'required',
            'matkul' => 'required',
            'lampiran' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $dosen = Dosen::whereId($request->input('id'))->update([
                'nama' => $request-> input('nama'),
                'email' => $request-> input('email'),
                'foto' => $request-> input('foto'),
                'kompetensi' => $request-> input('kompetensi'),
                'matkul' => $request-> input('matkul'),
                'lampiran' => $request-> input('lampiran'),
                'status' => $request-> input('status'),
            ]);

            if ($dosen) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $dosen);
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

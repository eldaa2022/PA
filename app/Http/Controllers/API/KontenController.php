<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Konten;
use App\Http\Resources\ResponseResource;


class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konten = Konten::latest()->paginate(5);
        return new ResponseResource(true,'list data kontak', $konten);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tggl_publish' => 'required',
            'tags' => 'required',
            'jenis_konten' => 'required',
            'status' => 'required',
            'lampiran' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048', //untuk foto
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $lampiran = $request->file('lampiran');
        $lampiran->storeAs('public/gambar', $lampiran->hashName());

        $konten = Konten::create([
            'judul' => $request-> judul,
            'deskripsi' => $request-> deskripsi,
            'tggl_publish' => $request-> tggl_publish,
            'tags' => $request-> tags,
            'jenis_konten' => $request-> jenis_konten,
            'status' => $request-> status,
            'lampiran' => $lampiran-> hashName(),
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $konten);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $konten = Konten::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $konten);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tggl_publish' => 'required',
            'tags' => 'required',
            'jenis_konten' => 'required',
            'status' => 'required',
            'lampiran' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $konten = Konten::whereId($request->input('id'))->update([
                'judul' => $request-> input('judul'),
                'deskripsi' => $request-> input('deskripsi'),
                'tggl_publish' => $request-> input('tggl_publish'),
                'tags' => $request-> input('tags'),
                'jenis_konten' => $request-> input('jenis_konten'),
                'status' => $request-> input('status'),
                'lampiran' => $request-> input('lampiran'),
            ]);

            if ($konten) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $konten);
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

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Http\Resources\ResponseResource;


class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenda = Agenda::latest()->paginate(5);

        return new ResponseResource(true,'list data kontak', $agenda);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'tags' => 'required',
            'lokasi' => 'required',
            'penyelenggara' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $agenda = Agenda::create([
            'judul' => $request-> judul,
            'deskripsi' => $request-> deskripsi,
            'tanggal' => $request-> tanggal,
            'tags' => $request-> tags,
            'lokasi' => $request-> lokasi,
            'penyelenggara' => $request-> penyelenggara,
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $agenda);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agenda = Agenda::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $agenda);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'tags' => 'required',
            'lokasi' => 'required',
            'penyelenggara' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $agenda = Agenda::whereId($request->input('id'))->update([
                'judul' => $request-> input('judul'),
                'deskripsi' => $request-> input('deskripsi'),
                'tanggal' => $request-> input('tanggal'),
                'tags' => $request-> input('tags'),
                'lokasi' => $request-> input('lokasi'),
                'penyelenggara' => $request-> input('penyelenggara'),
            ]);

            if ($agenda) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $agenda);
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

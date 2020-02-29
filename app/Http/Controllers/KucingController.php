<?php

namespace App\Http\Controllers;

use App\Kucing;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class KucingController extends Controller
{
  //* Fungsi menampilkan semua data
  public function index()
  {
    $kucings = Kucing::all();
    return response()->json($kucings);
  }

  //* Fungsi menampilkan single data
  public function show($id)
  {
    $kucing = Kucing::findOrFail($id);
    return response()->json($kucing);
  }

  //* Fungsi menambah data
  public function create(Request $request)
  {
    // Menambah gambar
    $image = $request->file('gambar');

    $new_name = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(base_path('public/images'), $new_name);

    $kucing = new Kucing();
    $kucing->nama = $request->nama;
    $kucing->jenis = $request->jenis;
    $kucing->umur = $request->umur;
    $kucing->gambar = $new_name;
    $kucing->save();

    return response()->json($kucing);
  }

  //* Fungsi mengupdate data
  public function update(Request $request, $id)
  {
    $kucing = Kucing::findOrFail($id);
    $kucing->nama = $request->nama;
    $kucing->jenis = $request->jenis;
    $kucing->umur = $request->umur;

    //* Jika gambar kosong maka query gambar
    //* menggunakan gambar_lama yg berisi gambar lama
    if (is_null($request->gambar)) {
      $kucing->gambar = $request->gambar_lama;
    } else {
      //* Jika ada query gambar maka akan diganti
      $image = $request->file('gambar');
      
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(base_path('public_html/images'), $new_name);
      
      $kucing->gambar = $new_name;
    }

    $kucing->save();

    return response()->json($kucing);
  }

  //* Fungsi menghapus data
  //* you must add hidden method _method = delete
  // to use this method
  public function destroy($id)
  {
    $kucing = Kucing::findOrFail($id);
    if ($kucing->delete()) {
      return response()->json($kucing);
    }
  }

}

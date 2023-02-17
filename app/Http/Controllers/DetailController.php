<?php

namespace App\Http\Controllers;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = Detail::select('nama_siswa','nama_kelas','judul_buku','tgl_pinjam')
        ->join('siswa','siswa.id_siswa','=','detail_peminjaman.id_siswa')
        ->join('buku','buku.id_buku','=','detail_peminjaman.id_buku')
        ->join('kelas','kelas.id_kelas','=','detail_peminjaman.id_kelas')
        ->get();

        return Response()->json($detail);
    }
}
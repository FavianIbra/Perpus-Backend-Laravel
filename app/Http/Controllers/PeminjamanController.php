<?php
namespace App\Http\Controllers;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Hash;

class PeminjamanController extends Controller
{
    public function getpeminjaman($id)
    {
        $dt_peminjaman=Peminjaman::select('nama_siswa', 'nama_kelas','judul_buku','tgl_pinjam', 'tgl_kembali','status')
        ->join('siswa', "siswa.id_siswa", "=" , 'peminjaman.id_siswa')
        ->join('kelas', "kelas.id_kelas", "=" , 'peminjaman.id_kelas')
        ->join('buku', "buku.id_buku", "=" , 'peminjaman.id_buku')
        ->where('id_peminjaman', '=', $id)
        ->get();
        return response()->json($dt_peminjaman);
    }

    public function createpeminjaman(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id_siswa'=>'required',
            'id_kelas'=>'required',
            'id_buku'=>'required',
            'tgl_kembali'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save = peminjaman::create([
            'id_siswa' =>$req->get('id_siswa'),
            'id_kelas' =>$req->get('id_kelas'),
            'id_buku' =>$req->get('id_buku'),
            'tgl_pinjam' =>date('Y-m-d H:i:s'),
            'tgl_kembali' =>$req->get('tgl_kembali'),
            'status' => 'dipinjam',
            
        ]);
        if($save){
            return Response()->json(['status'=>true,'message' => 'Proses peminjaman berhasil']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Proses peminjaman gagal']);
        }
    }
    
    public function deletepeminjaman($id){
        $hapus=Peminjaman::where('id_peminjaman',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>true,'message' => 'Sukses Menghapus data peminjaman']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menghapus data peminjaman']);
        }
        
    }

    public function kembalipeminjaman($id){
        $hapus=Peminjaman::where('id_peminjaman', "=", $id)
        ->update([
            'status' => 'Kembali' 
        ]);
        if($hapus){
            return Response()->json(['status'=>true,'message' => 'Sukses Mengembalikan buku ']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Mengembalikan buku ']);
        }
        
    }
}

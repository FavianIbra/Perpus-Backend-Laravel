<?php
namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Hash;

class BukuController extends Controller
{
    public function getbuku()
    {
        $dt_buku=Buku::get();
        return response()->json($dt_buku);
    }

    public function getsatubuku($id){
        $buku = Buku::where('id_buku','=',$id)->get();
            return response()->json($buku);
    }

    public function createbuku(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'judul_buku'=>'required',
            'pengarang'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save = buku::create([
            'judul_buku' =>$req->get('judul_buku'),
            'pengarang' =>$req->get('pengarang'),
        ]);
        if($save){
            return Response()->json(['status'=>true,'message' => 'Sukses Menambah Buku']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menambah Buku']);
        }
    }
    public function updatebuku(Request $req,$id)
    {
        $validator = Validator::make($req->all(),[
            'judul_buku'=>'required',
            'pengarang'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = buku::where('id_buku',$id)->update([
            'judul_buku'=>$req->get('judul_buku'),
            'pengarang'=>$req->get('pengarang'),
        ]);
        if($ubah){
            return Response()->json(['status'=>true, 'message' => 'Sukses Mengubah Buku']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal Mengubah Buku']);
        }
    }
    public function deletebuku($id){
        $hapus=Buku::where('id_buku',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>true,'message' => 'Sukses Menghapus Buku']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menghapus Buku']);
        }
        
    }
}

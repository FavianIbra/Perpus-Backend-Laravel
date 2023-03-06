<?php
namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function getsiswa()
    {
        $dt_siswa=Siswa::
        join('kelas','siswa.id_kelas','=','kelas.id_kelas')
        ->get();
        return response()->json($dt_siswa);
    }

    public function getsatusiswa($id){
        $getdetail = Siswa::where('id_siswa','=',$id)
        ->join('kelas','siswa.id_kelas','=','kelas.id_kelas')
        ->get();
            return response()->json($getdetail);
    }

    public function createsiswa(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nama_siswa'=>'required',
            'tanggal_lahir'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'id_kelas'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save = siswa::create([
            'nama_siswa' =>$req->get('nama_siswa'),
            'tanggal_lahir' =>$req->get('tanggal_lahir'),
            'gender' =>$req->get('gender'),
            'alamat' =>$req->get('alamat'),
            'id_kelas' =>$req->get('id_kelas'),
        ]);
        if($save){
            return Response()->json(['status'=>true,'message' => 'Sukses Menambah Siswa']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menambah Siswa']);
        }
    }
    public function updatesiswa(Request $req,$id)
    {
        $validator = Validator::make($req->all(),[
            'nama_siswa'=>'required',
            'tanggal_lahir'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'id_kelas'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = siswa::where('id_siswa',$id)->update([
            'nama_siswa'    =>$req->get('nama_siswa'),
            'tanggal_lahir' =>$req->get('tanggal_lahir'),
            'gender'        =>$req->get('gender'),
            'alamat'        =>$req->get('alamat'),
            'id_kelas'        =>$req->get('id_kelas'),

        ]);
        if($ubah){
            return Response()->json(['status'=>true, 'message' => 'Sukses mengubah siswa']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal mengubah siswa']);
        }
    }
    public function deletesiswa($id){
        $hapus=Siswa::where('id_siswa',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>true,'message' => 'Sukses menghapus data']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal menghapus data']);
        }
        
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    public $timestamp="null";
    protected $table="detail_peminjaman";
    protected $primarykey="id_detail";
    protected $fillable=['id_siswa','id_kelas','id_buku','tgl_pinjam','tgl_kembali'];
}
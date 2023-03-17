<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class siswa extends Authenticatable
{
    use HasFactory;
    protected $table = 'siswa';
   
    protected $guarded= [
        'id'
    ];

    public function spp()
    {
         return $this->belongsTo(Spp::class,'id_spp','id');
    }
   
   public function pembayaran(){
        return  $this->hasMany(Pembayaran::class,'id_spp');
   }
   
    public function kelas(){
        return  $this->belongsTo(Kelas::class,'id_kelas');
   }
}

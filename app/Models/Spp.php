<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    use HasFactory;
    protected $table = 'spp';
   
    protected $guarded = [
         'id'
    ];

    public function user()
   {
         return $this->belongsTo(User::class);
   }
}

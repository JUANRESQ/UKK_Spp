<?php

namespace Database\Seeders;

use App\Models\Spp;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'    => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'nama_petugas' => 'dimas',
            'level' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
         ]);
         
         User::create([
            'email'    => 'petugas@gmail.com',
            'username' => 'petugas',
            'password' => Hash::make('petugas'),
            'nama_petugas' => 'paiz',
            'level' => 'petugas',
            'created_at' => now(),
            'updated_at' => now()
         ]);

        Kelas::create([
            'nama_kelas' => 'XII RPL 2',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak'
        ]);

        Spp::create([
            'tahun' => 2020,
            'nominal' => 150000
        ]);

        Siswa::create([
            'nisn' => '123456789876',
            'nis'  => '22373687',
            'nama' => 'siswa',
            'id_kelas' => 1,
            'nomor_telp' => '089689957106',
            'alamat' => 'Majalengka',
            'id_spp' => 1
        ]);
        Siswa::create([
            'nisn' => '342456789432',
            'nis'  => '20206267',
            'nama' => 'Adrian Maulana ali',
            'id_kelas' => 1,
            'nomor_telp' => '082197585417',
            'alamat' => 'jalan jalan dekat jalanan',
            'id_spp' => 1
        ]);
        Siswa::create([
            'nisn' => '234156783243',
            'nis'  => '20206286',
            'nama' => 'Rafli Hikmatul Hilman',
            'id_kelas' => 1,
            'nomor_telp' => '0895704129749',
            'alamat' => 'gang PLN',
            'id_spp' => 1
        ]);

        Pembayaran::create([
            'id_petugas' => 2,
            'id_siswa' => 1,
            'spp_bulan' => 'februari',
            'jumlah_bayar' => 150000

        ]);
        Pembayaran::create([
            'id_petugas' => 1,
            'id_siswa' => 2,
            'spp_bulan' => 'februari',
            'jumlah_bayar' => 100000

        ]);
        Pembayaran::create([
            'id_petugas' => 1,
            'id_siswa' => 3,
            'spp_bulan' => 'februari',
            'jumlah_bayar' => 100000

        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\DataCheckpoint;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataCheckpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Muhammad Fauzi',
            'username' => 'fauzi',
            'password' => Hash::make('fauzi123'),
            'department' => 'Engineering'
        ]);
        User::create([
            'name' => 'Irfan Faiz',
            'username' => 'faiz',
            'password' => Hash::make('faiz123'),
            'department' => 'Engineering'
        ]);
        User::create([
            'name' => 'David Hidayat',
            'username' => 'david',
            'password' => Hash::make('david123'),
            'department' => 'Engineering'
        ]);
        User::create([
            'name' => 'Amaliiz',
            'username' => 'amalia',
            'password' => Hash::make('amalia123'),
            'department' => 'Engineering'
        ]);
        User::create([
            'name' => 'Aryo Kuncoro',
            'username' => 'aryo',
            'password' => Hash::make('aryo123'),
            'department' => 'Security'
        ]);
        User::create([
            'name' => 'Jejen',
            'username' => 'jejen',
            'password' => Hash::make('jejen123'),
            'department' => 'Security'
        ]);
        User::create([
            'name' => 'Taufik',
            'username' => 'taufik',
            'password' => Hash::make('taufik123'),
            'department' => 'Security'
        ]);
        // Message::create([
        //     'sender_id' => '1',
        //     'receiver_id' => '2',
        //     'message_content' => 'Halo, apakabar?'
        // ]);
        // Message::create([
        //     'sender_id' => '2',
        //     'receiver_id' => '1',
        //     'message_content' => 'Kabar baik bolo'
        // ]);
        DataCheckpoint::create([
            'kode_cp' => '1',
            'nama_cp' => 'CP_Pos_Security',
            'desc_cp' => 'Area musholla posko',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '2',
            'nama_cp' => 'CP_Gardu_PLN',
            'desc_cp' => 'Area gardu PLN',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '3',
            'nama_cp' => 'CP_Pintu_DMC',
            'desc_cp' => 'Pintu masuk area DMC',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '4',
            'nama_cp' => 'CP_Saung_Driver',
            'desc_cp' => 'Area saung driver parkiran',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '5',
            'nama_cp' => 'CP_Gudang_Belakang',
            'desc_cp' => 'Area gudang belakang DMC',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '6',
            'nama_cp' => 'CP_Parking_Pool',
            'desc_cp' => 'Area parkir mobil kantor & lapangan basket',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '7',
            'nama_cp' => 'CP_Testing_Belakang',
            'desc_cp' => 'Area belakang testing',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '8',
            'nama_cp' => 'CP_Lobby_Depan',
            'desc_cp' => 'Area depan pintu masuk lobby',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '9',
            'nama_cp' => 'CP_Gudang_Oli',
            'desc_cp' => 'Area gudang oli gedung DMC',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '10',
            'nama_cp' => 'CP_Testing_Samping',
            'desc_cp' => 'Area pintu samping testing',
            'lokasi_cp' => 'outdoor'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '12',
            'nama_cp' => 'CP_Ruang_Meeting_DMC',
            'desc_cp' => 'Area sudut dalam kanan atas R. Meeting DMC',
            'lokasi_cp' => 'dmc lt.2'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '11',
            'nama_cp' => 'CP_Engineering_DMC',
            'desc_cp' => 'Area sudut dalam kiri atas R. Engineering DMC',
            'lokasi_cp' => 'dmc lt.2'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '13',
            'nama_cp' => 'CP_Warehouse_DMC',
            'desc_cp' => 'Area gedung DMC antara R. MTC dan R. Warehouse',
            'lokasi_cp' => 'dmc lt.1'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '14',
            'nama_cp' => 'CP_Rolling_Door_DMC',
            'desc_cp' => 'Area gedung DMC Rolling Door belakang',
            'lokasi_cp' => 'dmc lt.1'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '15',
            'nama_cp' => 'CP_Mesin_Pojok_DMC',
            'desc_cp' => 'Area sudut dalam kanan bawah gedung DMC',
            'lokasi_cp' => 'dmc lt.1'
        ]);

        DataCheckpoint::create([
            'kode_cp' => '22',
            'nama_cp' => 'CP_PDE',
            'desc_cp' => 'Area ruang engineering marketing',
            'lokasi_cp' => 'office lt.2'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '23',
            'nama_cp' => 'CP_Masjid',
            'desc_cp' => 'Area masjid lantai 2',
            'lokasi_cp' => 'office lt.2'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '24',
            'nama_cp' => 'CP_Alkes',
            'desc_cp' => 'Area engineering Alkes',
            'lokasi_cp' => 'office lt.2'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '25',
            'nama_cp' => 'CP_Electrical',
            'desc_cp' => 'Area electrical dan sport center lantai 2',
            'lokasi_cp' => 'office lt.2'
        ]);

        DataCheckpoint::create([
            'kode_cp' => '16',
            'nama_cp' => 'CP_Lobby',
            'desc_cp' => 'Pintu akses kayu area lobby',
            'lokasi_cp' => 'office lt.1'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '17',
            'nama_cp' => 'CP_Testing',
            'desc_cp' => 'Area dalam ruang testing',
            'lokasi_cp' => 'office lt.1'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '18',
            'nama_cp' => 'CP_Project',
            'desc_cp' => 'Pintu darurat ruang testing',
            'lokasi_cp' => 'office lt.1'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '19',
            'nama_cp' => 'CP_Auditorium',
            'desc_cp' => 'Pintu darurat ruang auditorium',
            'lokasi_cp' => 'office lt.1'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '20',
            'nama_cp' => 'CP_Testing_Rolling_Door',
            'desc_cp' => 'Area rolling door ruang testing',
            'lokasi_cp' => 'office lt.1'
        ]);
        DataCheckpoint::create([
            'kode_cp' => '21',
            'nama_cp' => 'CP_Ruang_Meeting',
            'desc_cp' => 'Area pojok lorong ruang meeting',
            'lokasi_cp' => 'office lt.1'
        ]);
    }
}
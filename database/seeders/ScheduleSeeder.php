<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            [
                'tanggal'    => now()->addDays(7)->toDateString(),
                'waktu'      => '08:00:00',
                'lokasi'     => 'RS Umum Daerah Kota - Ruang Donor Lt. 2',
                'kuota'      => 30,
                'keterangan' => 'Donor darah rutin bulanan. Harap membawa KTP dan kartu donor.',
                'is_active'  => true,
            ],
            [
                'tanggal'    => now()->addDays(14)->toDateString(),
                'waktu'      => '09:00:00',
                'lokasi'     => 'Gedung PMI Kota - Aula Utama',
                'kuota'      => 50,
                'keterangan' => 'Donor darah massal. Tersedia snack dan sertifikat penghargaan.',
                'is_active'  => true,
            ],
            [
                'tanggal'    => now()->addDays(21)->toDateString(),
                'waktu'      => '08:30:00',
                'lokasi'     => 'Klinik Sehat Bersama - Ruang Tindakan',
                'kuota'      => 20,
                'keterangan' => 'Donor khusus golongan darah langka (AB-). Prioritas pendonor AB.',
                'is_active'  => true,
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::updateOrCreate(
                ['tanggal' => $schedule['tanggal'], 'lokasi' => $schedule['lokasi']],
                $schedule
            );
        }
    }
}

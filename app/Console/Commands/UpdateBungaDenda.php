<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman1;
use Carbon\Carbon;

class UpdateBungaDenda extends Command
{
    protected $signature = 'bunga-denda:update';
    protected $description = 'Update otomatis bunga dan denda pinjaman yang belum lunas';

    public function handle(): void
    {
        $pinjamans = Peminjaman1::where('status_lunas', false)->get();

        foreach ($pinjamans as $pinjaman) {
            if (!$pinjaman->jatuh_tempo) {
                continue;
            }

            $hariTelat = Carbon::parse($pinjaman->jatuh_tempo)->diffInDays(now(), false);

            if ($hariTelat > 0) {
                $dendaPerHari = 10000; // Bisa kamu ambil dari config juga
                $pinjaman->denda = $hariTelat * $dendaPerHari;
                $pinjaman->status_denda = true;
            }

            // Kembalikan bunga jika sebelumnya di-nol-kan
            if ($pinjaman->tbunga1 == 0 && $pinjaman->bunga_sebelumnya !== null) {
                $pinjaman->tbunga1 = $pinjaman->bunga_sebelumnya;
            }

            $pinjaman->save();
        }

        $this->info('Bunga dan denda berhasil diperbarui.');
    }
}

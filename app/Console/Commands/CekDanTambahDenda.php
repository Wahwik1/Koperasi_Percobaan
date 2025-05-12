<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman1;
use Carbon\Carbon;

class CekDanTambahDenda extends Command
{
    protected $signature = 'pinjaman:cek-denda';
    protected $description = 'Cek pinjaman yang lewat tenggat dan tambahkan denda';

    public function handle()
    {
        $today = Carbon::now();

        $pinjamans = Peminjaman1::where('status_lunas', false)
            ->whereDate('created_at', '<', $today->subDays(7)) // misal lewat 7 hari dari transaksi terakhir
            ->get();

        foreach ($pinjamans as $pinjaman) {
            $pinjaman->denda_dibayar += $pinjaman->bunga_sebelumnya * 0.1; // denda = 10% dari bunga sebelumnya
            $pinjaman->status_denda = true;
            $pinjaman->save();
        }

        $this->info('Denda berhasil diperiksa dan ditambahkan.');
    }
}
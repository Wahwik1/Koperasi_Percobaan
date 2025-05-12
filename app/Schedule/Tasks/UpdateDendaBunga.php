<?php

namespace App\Schedule\Tasks;

use App\Models\Peminjaman1;
use Illuminate\Support\Carbon;

class UpdateDendaBunga
{
    public function __invoke(): void
    {
        $pinjamans = Peminjaman1::where('status_lunas', false)->get();

        foreach ($pinjamans as $pinjaman) {
            $jatuhTempo = $pinjaman->jatuh_tempo;

            if ($jatuhTempo && now()->greaterThan(Carbon::parse($jatuhTempo))) {
                $denda = $pinjaman->tbunga1 ?? 0;

                // Update total bunga sebagai denda
                $pinjaman->update([
                    'ttotalbunga1' => $pinjaman->ttotalbunga1 + $denda,
                ]);
            }
        }
    }
}

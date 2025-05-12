<?php

namespace App\Jobs;

use App\Models\Peminjaman1;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KembalikanBungaPinjaman implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $bungaSebelumnya;

    public function __construct(Peminjaman1 $data, $bungaSebelumnya)
    {
        $this->data = $data;
        $this->bungaSebelumnya = $bungaSebelumnya;
    }

    public function handle()
    {
        Peminjaman1::where('pinjaman_id', $this->data->pinjaman_id)
            ->whereDate('created_at', now()->toDateString()) // bisa disesuaikan jika perlu
            ->where('tbunga1', 0)
            ->update([
                'tbunga1' => $this->bungaSebelumnya,
                'ttotalbunga1' => $this->bungaSebelumnya,
            ]);
    }
}

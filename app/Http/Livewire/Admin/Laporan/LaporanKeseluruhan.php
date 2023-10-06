<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LaporanKeseluruhan extends Component
{
    protected $listeners = ['submitButton'];

    public $jenis_pembayaran = [], $total_transaksi, $grand_total, $total_biaya_pengiriman;

    public function render()
    {
        return view('livewire.admin.laporan.laporan-keseluruhan')->layout('livewire.layouts.admin-layout');
    }

    public function submitButton($date)
    {
        $startDate = Carbon::createFromFormat('m/d/Y', $date['startDate'])->format('Y-m-d');
        $endDate = Carbon::createFromFormat('m/d/Y',  $date['endDate'])->format('Y-m-d');


        $this->jenis_pembayaran = DB::table('transaction')
            ->where('status', 'selesai')
            ->whereDate('completed_at', '>=', $startDate)
            ->whereDate('completed_at', '<=', $endDate)
            ->join('bukti_pembayaran', 'bukti_pembayaran.transaction_id_transaction', 'transaction.id_transaction')
            ->select('bukti_pembayaran.jenis_rekening', DB::raw('count(*) as jumlah'), DB::raw('SUM(grand_total) as grand_total'))
            ->groupBy('jenis_rekening')
            ->get();

        $this->total_transaksi = Transaction::where('status', 'selesai')
            ->whereDate('completed_at', '>=', $startDate)
            ->whereDate('completed_at', '<=', $endDate)
            ->count();

        $this->grand_total = Transaction::where('status', 'selesai')
            ->whereDate('completed_at', '>=', $startDate)
            ->whereDate('completed_at', '<=', $endDate)
            ->sum('grand_total');

        $this->total_biaya_pengiriman = Transaction::where('status', 'selesai')
            ->whereDate('completed_at', '>=', $startDate)
            ->whereDate('completed_at', '<=', $endDate)
            ->join('informasi_pengiriman', 'informasi_pengiriman.transaction_id_transaction', 'transaction.id_transaction')

            ->sum('informasi_pengiriman.biaya_pengiriman');
    }
}

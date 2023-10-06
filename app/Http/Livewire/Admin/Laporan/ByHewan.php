<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ByHewan extends Component
{
    protected $listeners = ['submitButton'];

    public $jenis_hewan = [], $total_transaksi, $grand_total, $total_biaya_pengiriman;

    public function render()
    {
        return view('livewire.admin.laporan.by-hewan')->layout('livewire.layouts.admin-layout');
    }

    public function submitButton($date)
    {
        $startDate = Carbon::createFromFormat('m/d/Y', $date['startDate'])->format('Y-m-d');
        $endDate = Carbon::createFromFormat('m/d/Y',  $date['endDate'])->format('Y-m-d');


        $this->jenis_hewan = DB::table('transaction')
            ->where('transaction.status', 'selesai')
            ->whereDate('completed_at', '>=', $startDate)
            ->whereDate('completed_at', '<=', $endDate)
            ->join('transaction_detail', 'transaction_detail.transaction_id_transaction', 'transaction.id_transaction')
            ->join('list_animal','transaction_detail.list_animal_id_animal','id_animal')
            ->select('list_animal.jenis_hewan', DB::raw('count(*) as jumlah'), DB::raw('SUM(subtotal) as subtotal'))
            ->groupBy('jenis_hewan')
            ->get();
        

        // $this->total_transaksi = $this->jenis_hewan[0] + $this->jenis_hewan[1];

        $this->grand_total = Transaction::where('status', 'selesai')
            ->whereDate('completed_at', '>=', $startDate)
            ->whereDate('completed_at', '<=', $endDate)
            ->sum('grand_total');

    }
}

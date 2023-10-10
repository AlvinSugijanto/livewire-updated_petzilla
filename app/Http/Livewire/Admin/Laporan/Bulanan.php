<?php

namespace App\Http\Livewire\Admin\Laporan;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Bulanan extends Component
{
    public $bulan, $tahun;

    public $openChart = false;

    public $tanggals = [];

    public function render()
    {
        return view('livewire.admin.laporan.bulanan')->layout('livewire.layouts.admin-layout');
    }
    public function onSubmit()
    {
        $startDate = Carbon::createFromFormat('d/m/Y', '01/' . $this->bulan . '/' . $this->tahun);
        $endDate = Carbon::parse($startDate)->endOfMonth();

        $queryResult = DB::table('transaction')
            ->where('status', 'selesai')
            ->whereDate('completed_at', '>=', $startDate)
            ->whereDate('completed_at', '<=', $endDate)
            ->join('informasi_pengiriman', 'informasi_pengiriman.transaction_id_transaction', 'transaction.id_transaction')
            ->select(DB::raw("(DATE_FORMAT(completed_at, '%d-%m-%Y')) as tanggal"), DB::raw('count(*) as jumlah'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(biaya_pengiriman) as biaya_pengiriman'))
            ->groupBy(DB::raw("DATE_FORMAT(completed_at, '%d-%m-%Y')"))
            ->get();

        $period = CarbonPeriod::create($startDate, $endDate);
        $period_array = $period->toArray();

        $temp = [];

        foreach ($queryResult as $record) {
            $temp[$record->tanggal] = [
                'jumlah' => $record->jumlah,
                'grand_total' => $record->grand_total,
                'biaya_pengiriman' => $record->biaya_pengiriman,
            ];
        }

        $results=[];

        $i=0;
        foreach ($period_array as $date) {
            $formattedDate = $date->format('d-m-Y');

            if (!isset($temp[$formattedDate])) {
                
                $results[$i] = [
                    'tanggal' => $formattedDate,
                    'jumlah' => 0,
                    'grand_total' => 0,
                    'biaya_pengiriman' => 0,
                ];

            } else{
                
                $results[$i] = [
                    'tanggal' => $formattedDate,
                    'jumlah' => $temp[$formattedDate]['jumlah'],
                    'grand_total' => $temp[$formattedDate]['grand_total'],
                    'biaya_pengiriman' => $temp[$formattedDate]['biaya_pengiriman'],
                ];
            }
            $i++;
        }
        $this->tanggals = $results;
        $this->emit('chartLoaded', $this->tanggals);
        $this->openChart = true;
        


    }
}

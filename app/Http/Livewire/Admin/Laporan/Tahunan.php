<?php

namespace App\Http\Livewire\Admin\Laporan;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tahunan extends Component
{
    public $tahun;

    public $datas = [];

    public $openChart = false;

    public function render()
    {
        return view('livewire.admin.laporan.tahunan')->layout('livewire.layouts.admin-layout');
    }
    public function onSubmit()
    {
        // $startMonth = $this->tahun.'/'.'01';
        // $endMonth = $this->tahun.'/'.'12';
        $startMonth = Carbon::createFromFormat('Y/m', $this->tahun . '/' . '01');
        $endMonth = Carbon::createFromFormat('Y/m', $this->tahun . '/' . '12');


        $queryResult = DB::table('transaction')
            ->where('status', 'selesai')
            ->whereYear('completed_at', '>=', $this->tahun)
            ->join('informasi_pengiriman', 'informasi_pengiriman.transaction_id_transaction', 'transaction.id_transaction')
            ->select(DB::raw("(DATE_FORMAT(completed_at, '%m-%Y')) as bulan"), DB::raw('count(*) as jumlah'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(biaya_pengiriman) as biaya_pengiriman'))
            ->groupBy(DB::raw("DATE_FORMAT(completed_at, '%m-%Y')"))
            ->get();

        // dd($queryResult);
        $period = CarbonPeriod::create($startMonth, '1 month', $endMonth);

        $period_array = $period->toArray();
        // dd($period->toArray());
        // $period = CarbonPeriod::create($startDate, $endDate);

        $temp = [];

        foreach ($queryResult as $record) {
            // $formattedRecord = $record->bulan->format('F');
            
            $temp[$record->bulan] = [
                'jumlah' => $record->jumlah,
                'grand_total' => $record->grand_total,
                'biaya_pengiriman' => $record->biaya_pengiriman,
            ];
        }

        $results=[];

        $i=0;
        foreach ($period_array as $date) {
            $formattedDate = $date->format('m-Y');

            if (!isset($temp[$formattedDate])) {

                $results[$i] = [
                    'bulan' => $date->format('F'),
                    'jumlah' => 0,
                    'grand_total' => 0,
                    'biaya_pengiriman' => 0,
                ];

            } else{

                $results[$i] = [
                    'bulan' => $date->format('F'),
                    'jumlah' => $temp[$formattedDate]['jumlah'],
                    'grand_total' => $temp[$formattedDate]['grand_total'],
                    'biaya_pengiriman' => $temp[$formattedDate]['biaya_pengiriman'],
                ];
            }
            $i++;
        }

        // dd($results);
        $this->datas = $results;
        $this->emit('chartLoaded', $this->datas);
        $this->openChart = true;



    }
}

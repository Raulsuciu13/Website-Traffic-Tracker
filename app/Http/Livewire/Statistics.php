<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\DB;
use App\Models\Visits;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\Component;

class Statistics extends Component
{
    use WithPagination;

    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = date('Y-m-d');
        $this->endDate = date('Y-m-d');
    }

    public function render()
    {
        $visits = Visits::query()
                ->when($this->startDate && $this->endDate, function ($query) {
                    $startDate = Carbon::createFromFormat('Y-m-d', $this->startDate)->startOfDay();
                    $endDate = Carbon::createFromFormat('Y-m-d',  $this->endDate)->endOfDay();
                    return $query->whereBetween('timestamp', [$startDate, $endDate]);
                })
                ->when($this->startDate && !$this->endDate, function ($query) {
                    return $query->where('timestamp', '>=', $this->startDate);
                })
                ->when(!$this->startDate && $this->endDate, function ($query) {
                    return $query->where('timestamp', '<=', $this->endDate);
                })
                ->selectRaw('page_url, count(*) as visit_count')
                ->groupBy(['page_url'])
                ->paginate(25);

        return view('livewire.statistics', ['visits' => $visits]);
    }
}

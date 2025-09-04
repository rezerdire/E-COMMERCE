<?php

namespace App\Filament\Widgets;

use App\Models\OrderProduct;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BarChart extends ChartWidget
{
    protected ?string $heading = 'Bar Chart';
    protected static ?int $sort = 2;
    protected function getData(): array
    {
         $filter = $this->filter ?? 'weekly'; // default filter
        $now = now();

         $startOfWeek = $now->copy()->startOfWeek(Carbon::MONDAY);
    $endOfWeek   = $now->copy()->endOfWeek(Carbon::SUNDAY);
            
        if ($filter === 'weekly') {
                // Define labels manually (MySQL: 1=Sunday, 7=Saturday)
                $labels = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

                $sales = OrderProduct::selectRaw('DAYOFWEEK(created_at) as dow, SUM(total_amount) as total')
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->groupBy('dow')
                    ->pluck('total', 'dow'); // keys are 1–7

                $data = collect(range(1,7))->map(fn($i) => $sales[$i] ?? 0);

                return [
                    'datasets' => [
                        [
                            'label' => 'Total Sales',
                            'data' => $data->toArray(),
                            'backgroundColor' => '#facc15',
                        ],
                    ],
                    'labels' => $labels,
                ];


    } //first if
    
    
    
    elseif ($filter === 'yearly') {
        // All months in current year
        $labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        $sales = OrderProduct::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->whereYear('created_at', $now->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $data = collect(range(1,12))->map(fn($m) => $sales[$m] ?? 0);

    } //2nd if
    
    
    else {
        // All days in current month
        $daysInMonth = $now->daysInMonth;
        $labels = range(1, $daysInMonth);

        $sales = OrderProduct::selectRaw('DAY(created_at) as day, SUM(total_amount) as total')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->groupBy('day')
            ->pluck('total', 'day');

        $data = collect(range(1, $daysInMonth))->map(fn($d) => $sales[$d] ?? 0);
        } //3rd if

        
         return [
        'datasets' => [
            [
                'label' => 'Total Sales',
                'data' => $data->toArray(),
                'backgroundColor' => '#facc15',
                'borderColor' => '#facc15',
            ],
        ],
        'labels' => $labels,
    ];
        
    }


    protected function getFilters(): ?array
    {
        return [
            'weekly'  => 'This Week',
            'monthly' => 'This Month',
            'yearly'  => 'This Year',
        ];
    }
    protected function getType(): string
    {
        return 'bar';
    }
}

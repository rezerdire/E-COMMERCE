<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\OrderProduct;
use Illuminate\Support\Carbon;

class SalesChart extends ChartWidget
{
    protected ?string $heading = 'Sales Overview';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $filter = $this->filter; // current filter value
        $now = Carbon::now();

        $query = OrderProduct::query();

        // apply filter
        if ($filter === 'weekly') {
            $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
        } elseif ($filter === 'monthly') {
            $query->whereYear('created_at', $now->year)
                  ->whereMonth('created_at', $now->month);
        } elseif ($filter === 'yearly') {
            $query->whereYear('created_at', $now->year);
        }

        // group data by day/month depending on filter
        $sales = $query->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => array_values($sales->toArray()),
                ],
            ],
            'labels' => array_keys($sales->toArray()),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'weekly'  => 'This Week',
            'monthly' => 'This Month',
            'yearly'  => 'This Year',
        ];
    }
}

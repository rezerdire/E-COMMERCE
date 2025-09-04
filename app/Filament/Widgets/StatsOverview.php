<?php

namespace App\Filament\Widgets;

use App\Models\Customers;
use App\Models\OrderProduct;
use App\Models\Products;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {

        $newCustomers = Customers::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $ProductStock = Products::where('stock', '<=',  '10' )->count();
        $Delivered = OrderProduct::sum('total_amount');
        $DeliveredFormatted = '₱' . number_format($Delivered, 2); 

        return [
            
            
          Stat::make('Total Customers', Customers::count())
            ->descriptionIcon(Heroicon::UserGroup, IconPosition::Before)
            ->description( $newCustomers . ' New Customers ')
            ->color('success'),
            

            Stat::make('Product Stock', $ProductStock)
            ->description('Low Product Stocks')
            ->descriptionIcon(Heroicon::ArrowTrendingDown)
            ->color('danger'),


        Stat::make('Total Sales', '₱'  .   number_format(OrderProduct::sum('total_amount'), 2))
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
    }
}

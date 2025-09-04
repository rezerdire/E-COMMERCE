<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages\CreateOrders;
use App\Filament\Resources\Orders\Pages\EditOrders;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Filament\Resources\Orders\Schemas\OrdersForm;
use App\Filament\Resources\Orders\Tables\OrdersTable;
use App\Models\Orders;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrdersResource extends Resource
{

      public static function getNavigationGroup(): ?string
        {
            return 'Order & Delivery'; 
        }

        
    protected static ?string $model = Orders::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Truck;

    protected static ?string $recordTitleAttribute = 'Orders';

    public static function form(Schema $schema): Schema
    {
        return OrdersForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
    }



 public static function getNavigationBadgeTooltip(): ?string
{
    $count = static::getFilteredCount(); // use the correct method
    if ($count > 0) {
        return "There are $count new orders";
    }
    return "No Order";
}

protected static function getFilteredCount(): int
{
    return static::$model::whereIn('delivery_status', ['new'])->count();
}

// Badge number
public static function getNavigationBadge(): ?string
{
    return (string) static::getFilteredCount();
}

// Badge color based on the same count
public static function getNavigationBadgeColor(): ?string
{
    return static::getFilteredCount() <= 1 ? 'warning' : 'primary';
}







    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'create' => CreateOrders::route('/create'),
            'edit' => EditOrders::route('/{record}/edit'),
        ];
    }
}

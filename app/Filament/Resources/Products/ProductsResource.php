<?php
namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProducts;
use App\Filament\Resources\Products\Pages\EditProducts;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductsForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Products;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductsResource extends Resource
{
    public static function getNavigationGroup(): ?string
    {
        return 'Products Creation'; 
    }

    protected static ?string $model = Products::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;

    protected static ?string $recordTitleAttribute = 'Products';

    public static function form(Schema $schema): Schema
    {
        return ProductsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    // Helper method: count products with low stock (<= 5)
    protected static function getLowStockCount(): int
    {
        return static::$model::where('stock', '<=', 5)->count();
    }

    // Navigation badge shows low stock count
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getLowStockCount();
    }

    // Badge color: danger if there are low stock products
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getLowStockCount() > 0 ? 'danger' : 'primary';
    }

    public static function getNavigationBadgeTooltip(): ?string
{
    $count = static::getLowStockCount();
    if ($count > 0) {
        return "There are $count products with low stock";
    }
    return "All products are sufficiently stocked";
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
            'index' => ListProducts::route('/'),
            'create' => CreateProducts::route('/create'),
            'edit' => EditProducts::route('/{record}/edit'),
        ];
    }
}

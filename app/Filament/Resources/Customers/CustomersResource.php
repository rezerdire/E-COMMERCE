<?php

namespace App\Filament\Resources\Customers;

use App\Filament\Resources\Customers\Pages\CreateCustomers;
use App\Filament\Resources\Customers\Pages\EditCustomers;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Schemas\CustomersForm;
use App\Filament\Resources\Customers\Tables\CustomersTable;
use App\Models\Customers;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CustomersResource extends Resource
{

        public static function getNavigationGroup(): ?string
        {
            return 'Order & Delivery'; 
        }

    protected static ?string $model = Customers::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'Customer Accounts';

    public static function form(Schema $schema): Schema
    {
        return CustomersForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomersTable::configure($table);
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
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomers::route('/create'),
            'edit' => EditCustomers::route('/{record}/edit'),
        ];
    }
}

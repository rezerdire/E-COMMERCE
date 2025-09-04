<?php

namespace App\Filament\Resources\Brands\Schemas;

use App\Models\brand;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->Schema([
                TextInput::make('name')
                    ->required()
                      ->maxLength(255)
                    ->live(onBlur: true) 
                    ->afterStateUpdated(fn(string $operation, $state, Set $set )=> $operation
                === 'create'? $set('slug', Str::slug($state)):null),

            TextInput::make('slug')
                ->required()
                ->disabled()
                ->dehydrated()
                ->unique(brand::class, 'slug', ignoreRecord:true),

        
            Toggle::make('is_active')
                ->default(true)
                 ->helperText('u can turn this off if the category is no longer available'),
                 
                ])->columnSpan(2)->columns(2),
            ])->columns(2);
    }
}

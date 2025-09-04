<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\category;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
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
                ->unique(category::class, 'slug', ignoreRecord:true),                
                MarkdownEditor::make('description')->columnSpanFull(),

                ])->columns(2)->columnSpan(2),

                Section::make()->schema([
                Toggle::make('is_active')
                ->required()
                ->helperText('u can turn this off if the category is no longer available'),
                     ])->columns(1)->columnSpan(1),
            ])->columns(3);
    }
}

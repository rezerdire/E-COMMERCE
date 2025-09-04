<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                
                Section::make()
                ->schema([
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name'),
                TextInput::make('last_name')
                    ->required(), 
                ])->columns(3)->columnSpan(3), 

                Section::make([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->prefix('+63'),  
                    
                ])->columns(2)->columnSpan(3),

                Section::make([
                Textarea::make('address')
                    ->required()
                    ->rows(4), 
                
                ])->columns(1)->columnSpanFull(),
        
        
        
        ])->columns(3);
    }
}

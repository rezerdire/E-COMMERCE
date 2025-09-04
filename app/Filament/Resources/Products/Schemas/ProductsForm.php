<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Products;
use App\Models\Brands;
use App\Models\Category;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ProductsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Details')
                ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Product Name')
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $operation, $state, Set $set )=> $operation
                === 'create'? $set('slug', \Illuminate\Support\Str::slug($state)):null),


                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->unique(Products::class, 'slug', ignoreRecord:true),

                Select::make('category_id')
                ->label('Category Name')
                    ->required()
                    ->relationship('Category', 'name')
                    ->searchable()
                    ->preload(),
            

                Select::make('brand_id')
                ->required()
                ->relationship('Brand',  'name')
                ->searchable()
                ->preload(),
                

               

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₱'),

                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->step(1) //taga block ng decimal kupal ung mga naglalagay ng ganon e
                    //Logic every time na mag 0 stock matic inactive pero pag naging > 1 magiging active ulet
                      ->afterStateUpdated(function ($state, $set) {
                        $set('is_active', $state > 0);
                    }),

                MarkdownEditor::make('description')->columnSpanFull(),

                ])->columns(2)->columnSpan( 2), // COLUMN SPAN UNG HABA EH ANG OVERALL COLUMN BASED SA BUONG SCHEMA AY TATLO DBA?? SO OCCUPY SO BALE 80% NG WIDTH SA KANYA


                Section::make("Upload Image")
                    ->schema([
                
                        FileUpload::make('image')
                        ->image(), //IMAGE

                        Toggle::make('is_active')
                            ->required() //ACTIVE SHIT
                            ->helperText('This automatically active if the product is being created, 
                            u can turn it off if u want it to be inactive'),
                ])->columns(1), //COLUMN  
                     
                           
                        
            ])->columns(3); //ETO UNG BUONG COLUMN NG CONTAINER

    }
}

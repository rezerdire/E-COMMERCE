<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Products;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Number;

class OrdersForm
{
    public static function configure(Schema $schema): Schema
    {
         return $schema
            ->components([
                
                    Section::make('Order Information')->schema([

                        //Customer Name
                    Select::make('customer_id')
                    ->relationship('customer', 'id') 
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        collect([$record->first_name, $record->middle_name, $record->last_name])
                            ->filter()
                            ->implode(' ')
                    )
                    ->required()
                    ->searchable()
                    ->preload()->columnSpan(2),

                    Select::make('payment_method')
                    ->options(['Cash'=> 'Cash', 'GCash' => 'GCash', 'COD' => 'Cash on Delivery'])
                    ->default('Cash')
                    ->required(),

                    Select::make('payment_status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'refunded' => 'Refunded'])
                    ->default('pending')
                    ->required(),

                    TextInput::make('shipping_amount')
                    ->label('Shipping Amount')
                    ->required()
                    ->default('0')
                    ->numeric()
                    ->prefix('₱')
                    ->reactive()
                    ->dehydrated(),

                    ToggleButtons::make('delivery_status')
                    ->inline()
                    ->options(['new' => 'New', 'processing' => 'Processing','shipped' => 'Shipped', 'delivered' => 'Delivered', 'canceled' => 'Canceled'])
                    ->default('new')
                    ->required()
                    ->colors([
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'info',
                        'delivered' => 'success',
                        'canceled' =>  'danger'
                    ])
                    ->icons([
                        'new' => Heroicon::Sparkles,
                        'processing' => Heroicon::ArrowPath,
                        'shipped' => Heroicon::Truck,
                        'delivered' => Heroicon::CheckBadge,
                        'cancelled' => Heroicon::XCircle,
                    ]),
                    
                ])->columnSpanFull(),


                Section::make('Product Information')
                ->schema([
                    Repeater::make('orderProduct')
                    ->label('Add Products')
                        ->relationship() 
                        ->schema([
                            Select::make('product_id')
                                ->relationship('product', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->columnSpan(3)
                                ->reactive()
                                ->afterStateUpdated(fn($state, Set $set)=> $set('unit_amount', Products::find($state)?->price ?? 0))
                                ->afterStateUpdated(fn($state, Set $set)=> $set('total_amount', Products::find($state)?->price ?? 0)),


                            TextInput::make('quantity')
                                ->required()
                                ->numeric()
                                ->default(1) 
                                ->minValue(1)
                                ->columnSpan(3)
                                ->reactive()
                                ->afterStateUpdated(fn($state, Set $set, Get $get)=> $set('total_amount', $state*$get('unit_amount'))),

                            TextInput::make('unit_amount')
                                ->required()
                                ->numeric()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(3),

                            TextInput::make('total_amount')
                                ->required()
                                ->numeric()
                                ->dehydrated()
                                ->columnSpan(3),

                        ])->columns(12),
                    
                             Placeholder::make('shipping_fee_placeholder')
                            ->label('Shipping Fee')
                            ->color('danger')
                            ->content(function (Get $get) {
                                $shipping = $get('shipping_amount') ?? 0;
                                return Number::currency($shipping, 'PHP');
                            }),

                        Placeholder::make('grand_total_placeholder')
                        ->label('Grand Total')
                        ->color('success')
                        ->content(function(Get $get, Set $set){
                            $total = 0;

                            if(!$repeaters = $get('orderProduct')){
                                return $total;
                            }

                            foreach($repeaters as $key => $repeater){
                                $total += $get("orderProduct.{$key}.total_amount");
                            }

                                // plus shipping fee
                                $shipping = $get('shipping_amount') ?? 0;
                                $grandTotal = $total + $shipping;

                                // Update hidden grand_total field
                                $set('grand_total', $grandTotal);

                                return Number::currency($grandTotal, 'PHP');
                        }),
                        Hidden::make('grand_total')
                        ->default(0) 

                ])->columnSpanFull() //ending ng repeater


            ]);

    }
}

<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Orders;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
       

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.full_name')
                ->sortable()
                ->searchable(['first_name', 'middle_name', 'last_name']),

                TextColumn::make('grand_total')
                ->numeric()
                ->sortable()
                ->money('PHP'),

                TextColumn::make('payment_method')
                ->searchable()
                ->sortable(),
 
                 TextColumn::make('payment_status')
                ->searchable()
                ->sortable(),


                SelectColumn::make('delivery_status')
                ->options(['new' => 'New', 'processing' => 'Processing','shipped' => 'Shipped', 'delivered' => 'Delivered', 'canceled' => 'Canceled'])
                ->searchable()
                ->sortable(),
    
                TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true)
                
                
            ])
            ->filters([
                SelectFilter::make('delivery_status')
                ->options(['new' => 'New', 'processing' => 'Processing','shipped' => 'Shipped', 'delivered' => 'Delivered', 'canceled' => 'Canceled']),

                SelectFilter::make('payment_method')
                ->options(['Cash'=> 'Cash', 'GCash' => 'GCash', 'COD' => 'Cash on Delivery']),
                
                SelectFilter::make('payment_status')
                ->options(['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'refunded' => 'Refunded'])


            ])

            ->recordActions([
                ActionGroup::make([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);

            
    }
}

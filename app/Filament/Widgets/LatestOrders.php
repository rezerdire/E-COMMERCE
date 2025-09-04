<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use \App\Models\Orders;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class LatestOrders extends TableWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Orders::query())
            ->columns([
                TextColumn::make('customer.full_name')
                ->label('Customer Name')
                ->searchable(),
                
                TextColumn::make('payment_method')
                ->label('Payment Method')
                ->sortable(),

                TextColumn::make('payment_status')
                ->label('Payment Status')
                ->sortable()
                ->badge()
                ->color( fn(string $state): string => match ($state){
                 'pending' => 'primary', 
                        'paid' => 'success', 
                        'failed' => 'danger', 
                        'refunded' => 'danger',

                }),
                
                TextColumn::make('delivery_status')
                ->sortable()
                ->label('Delivery Status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'new' => 'primary',
                    'processing' => 'warning',
                    'shipped' => 'info',
                    'delivered' => 'success',
                    'canceled' => 'danger',
                    default => 'gray',
                })
               ->icon(fn (string $state) => match ($state) {
                    'new' => Heroicon::Sparkles,
                    'processing' => Heroicon::ArrowPath,
                    'shipped' => Heroicon::Truck,
                    'delivered' => Heroicon::CheckBadge,
                    'canceled' => Heroicon::XCircle,
                    default => null,
                }),

                 TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),



            ])
            ->filters([
               SelectFilter::make('delivery_status')
                ->options(['new' => 'New', 'processing' => 'Processing','shipped' => 'Shipped', 'delivered' => 'Delivered', 'canceled' => 'Canceled']),

                SelectFilter::make('payment_method')
                ->options(['Cash'=> 'Cash', 'GCash' => 'GCash', 'COD' => 'Cash on Delivery']),
                
                SelectFilter::make('payment_status')
                ->options(['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'refunded' => 'Refunded'])
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}

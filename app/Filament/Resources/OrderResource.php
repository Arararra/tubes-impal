<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Commerce';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Tabs::make('OrderTabs')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('Order')
                                    ->icon('heroicon-o-shopping-bag')
                                    ->schema([
                                        Forms\Components\TextInput::make('receipt')
                                            ->label('Order Receipt')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255)
                                            ->disabled(),
                                        Forms\Components\TextInput::make('shipping_receipt')
                                            ->label('Shipping Receipt')
                                            ->nullable()
                                            ->maxLength(255)
                                            ->live(debounce: 500)
                                            ->afterStateUpdated(fn ($state, callable $set) =>
                                                $set('status', 'Shipped')
                                            ),
                                        Forms\Components\Select::make('status')
                                            ->label('Order Status')
                                            ->options([
                                                'Pending' => 'Pending',
                                                'Paid' => 'Paid',
                                                'Processing' => 'Processing',
                                                'Shipped' => 'Shipped',
                                                'Delivered' => 'Delivered',
                                            ])
                                            ->default('Pending')
                                            ->required(),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('total')
                                                    ->label('Total')
                                                    ->numeric()
                                                    ->prefix('Rp')
                                                    ->disabled(),
                                                Forms\Components\DateTimePicker::make('paid_date')
                                                    ->label('Paid Date')
                                                    ->nullable(),
                                            ]),
                                        Forms\Components\Repeater::make('orderProducts')
                                            ->relationship()
                                            ->columns(12)
                                            ->schema([
                                                Forms\Components\Select::make('product_id')
                                                    ->label('Product Name')
                                                    ->relationship('product', 'title')
                                                    ->disabled()
                                                    ->columnSpan(4),
                                                Forms\Components\TextInput::make('quantity')
                                                    ->label('Qty')
                                                    ->disabled()
                                                    ->columnSpan(2),
                                                Forms\Components\TextInput::make('price')
                                                    ->label('Price')
                                                    ->prefix('Rp')
                                                    ->disabled()
                                                    ->columnSpan(3),
                                                Forms\Components\TextInput::make('subtotal')
                                                    ->label('Subtotal')
                                                    ->prefix('Rp')
                                                    ->disabled()
                                                    ->default(fn ($record) => $record?->subtotal)
                                                    ->columnSpan(3),
                                            ])
                                            ->disableLabel()
                                            ->disabled()
                                            ->createItemButtonLabel('')
                                    ]),

                                Forms\Components\Tabs\Tab::make('Customer')
                                    ->icon('heroicon-o-user')
                                    ->schema([
                                        Forms\Components\TextInput::make('customer_name')
                                            ->label('Customer Name')
                                            ->maxLength(255)
                                            ->disabled(),
                                        Forms\Components\TextInput::make('customer_whatsapp')
                                            ->label('WhatsApp Number')
                                            ->tel()
                                            ->prefix('+62')
                                            ->disabled(),
                                        Forms\Components\TextInput::make('customer_city')
                                            ->label('Customer City')
                                            ->maxLength(255)
                                            ->disabled(),
                                        Forms\Components\TextInput::make('customer_postcode')
                                            ->label('Customer Postcode')
                                            ->maxLength(255)
                                            ->disabled(),
                                        Forms\Components\Textarea::make('customer_address')
                                            ->label('Address')
                                            ->rows(3)
                                            ->disabled(),
                                    ]),
                            ]),
                    ])
                    ->columnSpan(2),

                Forms\Components\Card::make([
                    Forms\Components\DateTimePicker::make('created_at')
                        ->label('Created At')
                        ->disabled()
                        ->dehydrated(false)
                        ->default(now()),
                    Forms\Components\DateTimePicker::make('updated_at')
                        ->label('Updated At')
                        ->disabled()
                        ->dehydrated(false)
                        ->default(now()),
                ])
                ->columnSpan([
                    'default' => 2,
                    'lg' => 1,
                ]),
            ])
            ->columns([
                'sm' => 1,
                'lg' => 3,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('receipt')
                    ->label('Receipt')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_whatsapp')
                    ->label('WhatsApp'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'gray',
                        'Paid' => 'info',
                        'Processing' => 'warning',
                        'Shipped' => 'primary',
                        'Delivered' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Paid' => 'Paid',
                        'Processing' => 'Processing',
                        'Shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

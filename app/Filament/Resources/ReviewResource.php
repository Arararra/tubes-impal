<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Commerce';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('order_id')
                                    ->label('Order')
                                    ->relationship('order', 'receipt')
                                    ->searchable()
                                    ->required(),
                                Forms\Components\Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'title')
                                    ->searchable()
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('rating')
                            ->label('Rating (1–5)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->required(),
                        Forms\Components\Textarea::make('body')
                            ->label('Comment')
                            ->rows(3)
                            ->maxLength(1000),
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
                Tables\Columns\TextColumn::make('order.receipt')
                    ->label('Receipt')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('product.title')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}

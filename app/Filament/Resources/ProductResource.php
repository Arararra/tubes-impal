<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Commerce';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Product Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image')
                            ->label('Product Image')
                            ->directory('products')
                            ->image()
                            ->imagePreviewHeight('150')
                            ->maxSize(2048)
                            ->nullable(),
                        Forms\Components\Select::make('categories')
                            ->label('Select Categories')
                            ->multiple()
                            ->relationship('categories', 'title')
                            ->preload()
                            ->searchable(),
                        Forms\Components\Textarea::make('body')
                            ->label('Description')
                            ->rows(4)
                            ->nullable(),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('Rp'),
                                Forms\Components\TextInput::make('stock')
                                    ->label('Stock')
                                    ->numeric()
                                    ->required(),
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
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categories.title')
                    ->label('Categories')
                    ->badge()
                    ->limitList(3),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR', true),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

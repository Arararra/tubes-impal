<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SingleResource\Pages;
use App\Filament\Resources\SingleResource\RelationManagers;
use App\Models\Single;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SingleResource extends Resource
{
    protected static ?string $model = Single::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(fn ($state, callable $set) =>
                                        $set('slug', \Str::slug($state))
                                    ),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(Single::class, 'slug', ignoreRecord: true),
                            ]),
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->directory('singles')
                            ->visibility('public')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('body')
                            ->label('Body')
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('accordions')
                            ->label('Accordions')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\Textarea::make('body')->required(),
                            ])
                            ->orderable()
                            ->collapsible()
                            ->columnSpanFull()
                            ->defaultItems(0),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
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
            'index' => Pages\ListSingles::route('/'),
            'create' => Pages\CreateSingle::route('/create'),
            'edit' => Pages\EditSingle::route('/{record}/edit'),
        ];
    }
}

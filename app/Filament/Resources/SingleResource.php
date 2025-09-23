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

    public static function form(Form $form): Form
    {
        return $form
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

                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('singles') // storage/app/public/singles
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
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
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

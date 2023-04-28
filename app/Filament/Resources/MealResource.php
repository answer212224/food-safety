<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MealResource\Pages;
use App\Filament\Resources\MealResource\RelationManagers;
use App\Models\Meal;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MealResource extends Resource
{
    protected static ?string $model = Meal::class;

    protected static ?string $label = '餐點';

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('effective_date')
                    ->required(),
                Forms\Components\TextInput::make('sid')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('brand')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('shop')
                    ->maxLength(255),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('chef')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('workspace')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qno')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('note')
                    ->maxLength(255),
                Forms\Components\TextInput::make('item')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('items')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('effective_date')
                    ->date(),
                Tables\Columns\TextColumn::make('sid'),
                Tables\Columns\TextColumn::make('brand'),
                Tables\Columns\TextColumn::make('shop'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('chef'),
                Tables\Columns\TextColumn::make('workspace'),
                Tables\Columns\TextColumn::make('qno'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('note'),
                Tables\Columns\TextColumn::make('item'),
                Tables\Columns\TextColumn::make('items'),
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
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMeals::route('/'),
            'create' => Pages\CreateMeal::route('/create'),
            'edit' => Pages\EditMeal::route('/{record}/edit'),
        ];
    }
}

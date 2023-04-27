<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Defect;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DefectResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DefectResource\RelationManagers;

class DefectResource extends Resource
{
    protected static ?string $model = Defect::class;

    protected static ?string $label = '缺失';

    protected static ?string $navigationIcon = 'heroicon-o-thumb-down';

    public function filter()
    {
        return [
            Filter::make('group')->label('group'),
            Filter::make('title')->label('title'),
        ];
    }

    public static function query()
    {
        return Defect::when(request('group'), function ($query, $group) {
            return $query->where('group', $group);
        })
            ->when(request('title'), function ($query, $title) {
                return $query->where('title', $title);
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('group')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('category')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group')
                    ->label('群組'),
                Tables\Columns\TextColumn::make('title')
                    ->label('標題'),
                Tables\Columns\TextColumn::make('category')
                    ->label('類別'),
                Tables\Columns\TextColumn::make('description')
                    ->label('描述'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date(),
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
            'index' => Pages\ListDefects::route('/'),
            'create' => Pages\CreateDefect::route('/create'),
            'edit' => Pages\EditDefect::route('/{record}/edit'),
        ];
    }
}

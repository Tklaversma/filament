<?php

namespace App\Filament\Resources;

use App\Enums\AccommodationTypeEnum;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\CityModel;
use App\Models\Post;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name'),
                TextColumn::make('title'),
                TextColumn::make('text')->formatStateUsing(fn(string $state) => str($state)->limit(50)->value()),
                TextColumn::make('color'),
            ])
            ->filters([
                SelectFilter::make('customer')
                            ->label('Customer')
                            ->relationship('customer', 'name')
                            ->native(false)
                            ->searchable()
                            ->preload()
                ,
                SelectFilter::make('color')
                            ->label('Color')
                            ->options(
                                function () {
                                    return Post::query()
                                               ->distinct()
                                               ->select('color')
                                               ->pluck('color', 'color')
                                               ->sortBy('color');
                                }
                            )
                            ->native(false)
                            ->searchable()
                            ->preload()
                ,
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
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

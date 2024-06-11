<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

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
                TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Posts')
//                                     ->url(function ($record) {
//                                         $query = http_build_query([
//                                             'tableFilters' => [
//                                                 'customer' => [
//                                                     'value' => $record->id,
//                                                 ],
//                                             ],
//                                         ]);
//
//                                         return ListPosts::getUrl() . '?' . urldecode($query);
//                                     })
                                     ->action(function ($record) {
                                         return redirect()->to(
                                             ListPosts::getUrl([
                                                 'tableFilters' => [
                                                     'customer' => [
                                                         'value' => $record->id,
                                                     ],
                                                 ],
                                             ])
                                         );
                                     })
                ,
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
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}

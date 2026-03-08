<?php

namespace App\Filament\Resources\GoodResource\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BorrowsRelationManager extends RelationManager
{
    protected static string $relationship = 'borrows';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('officer')
                    ->required()
                    ->maxLength(255),
                TextInput::make('borrower')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('borrow_date')
                    ->required(),
                DatePicker::make('return_date'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('borrower')
            ->columns([
                TextColumn::make('borrower'),
                TextColumn::make('borrower_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'internal' => 'info',
                        'external' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('borrow_date')
                    ->date(),
                TextColumn::make('return_date')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

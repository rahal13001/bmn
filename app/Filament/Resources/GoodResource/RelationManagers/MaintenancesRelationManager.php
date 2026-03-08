<?php

namespace App\Filament\Resources\GoodResource\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaintenancesRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenances';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('reason')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('maintenance_date')
                    ->required(),
                DatePicker::make('finish_date'),
                TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('documentation')
                    ->multiple()
                    ->maxFiles(4)
                    ->maxSize(10240)
                    ->acceptedFileTypes([
                        'image/jpeg', 'image/png', 'image/webp',
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->directory('documentation/maintenances'),
                Textarea::make('note'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('reason')
            ->columns([
                TextColumn::make('reason'),
                TextColumn::make('maintenance_date')
                    ->date(),
                TextColumn::make('finish_date')
                    ->date(),
                IconColumn::make('status')
                    ->label('Status')
                    ->state(fn ($record) => $record->finish_date !== null)
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning'),
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceResource\Pages;
use App\Models\Maintenance;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Actions;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $modelLabel = 'Pemeliharaan';
    protected static ?string $pluralModelLabel = 'Pemeliharaan';
    protected static ?string $navigationLabel = 'Pemeliharaan';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static string | UnitEnum | null $navigationGroup = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Pemeliharaan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Select::make('good_id')
                            ->label('Barang')
                            ->relationship('good', 'id_bmn')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                            ->searchable(['id_bmn', 'color', 'groups.name', 'groups.brand'])
                            ->preload()
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('reason')
                            ->label('Alasan/Deskripsi Perbaikan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('location')
                            ->label('Penyedia/Vendor')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan(['sm' => 12, 'md' => 8]),

                Section::make('Lini Masa & Dokumentasi')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        DatePicker::make('maintenance_date')
                            ->label('Tanggal Pemeliharaan')
                            ->required(),
                        DatePicker::make('finish_date')
                            ->label('Tanggal Selesai'),
                        FileUpload::make('documentation')
                            ->label('Dokumentasi')
                            ->multiple()
                            ->maxFiles(4)
                            ->maxSize(10240)
                            ->acceptedFileTypes([
                                'image/jpeg', 'image/png', 'image/webp',
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ])
                            ->directory('documentation/maintenances')
                            ->panelLayout('grid')
                            ->columnSpanFull(),
                        Textarea::make('note')
                            ->label('Catatan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan(['sm' => 12, 'md' => 4]),
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('good.id_bmn')
                    ->label('ID BMN')
                    ->searchable(),
                TextColumn::make('reason')
                    ->label('Deskripsi Perbaikan')
                    ->searchable(),
                TextColumn::make('maintenance_date')
                    ->label('Tanggal Pemeliharaan')
                    ->date()
                    ->sortable(),
                TextColumn::make('finish_date')
                    ->label('Tanggal Selesai')
                    ->date()
                    ->sortable(),
                IconColumn::make('status')
                    ->label('Selesai')
                    ->state(fn ($record) => $record->finish_date !== null)
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMaintenances::route('/'),
            'create' => Pages\CreateMaintenance::route('/create'),
            'edit' => Pages\EditMaintenance::route('/{record}/edit'),
        ];
    }
}

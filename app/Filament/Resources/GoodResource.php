<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodResource\Pages;
use App\Filament\Resources\GoodResource\RelationManagers;
use App\Models\Good;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class GoodResource extends Resource
{
    protected static ?string $model = Good::class;

    protected static ?string $modelLabel = 'Barang';
    protected static ?string $pluralModelLabel = 'Barang';
    protected static ?string $navigationLabel = 'Barang';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cube';

    protected static string | UnitEnum | null $navigationGroup = 'Data Induk';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Barang')
                    ->icon('heroicon-o-information-circle')
                    ->description('Informasi dasar dan identifikasi.')
                    ->schema([
                        TextInput::make('id_bmn')
                            ->label('ID BMN')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name')
                            ->label('Nama Barang')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nup')
                            ->label('NUP')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('brand')
                            ->label('Merek')
                            ->required()
                            ->maxLength(255),
                        Select::make('group_id')
                            ->label('Kelompok')
                            ->relationship('group', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('room_id')
                            ->label('Ruangan')
                            ->relationship('room', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('color')
                            ->label('Warna')
                            ->maxLength(255),
                        Select::make('ownership')
                            ->label('Status Penguasaan')
                            ->options([
                                'a' => 'a) digunakan seluruhnya untuk penyelenggaraan tupoksi;',
                                'b' => 'b) digunakan untuk dioperasikan;',
                                'c' => 'c) digunakan oleh unit kerja lain dalam Kementerian/Lembaga yang sama;',
                                'd' => 'd) digunakan oleh unit kerja lain dalam Kementerian/Lembaga yang berbeda;',
                                'e' => 'e) digunakan oleh pihak lain tidak sesuai dengan peraturan;',
                                'f' => 'f) dimanfaatkan: sewa;',
                                'g' => 'g) dimanfaatkan: pinjam pakai;',
                                'h' => 'h) dimanfaatkan: Kerjasama Pemanfaatan (KSP);',
                                'i' => 'i) dimanfaatkan: Bangun Guna Serah (BGS)/Bangun Serah Guna (BSG);',
                                'j' => 'j) penggunaan lain sesuai dengan peraturan;',
                                'k' => 'k) dimanfaatkan tidak sesuai dengan peraturan;',
                                'l' => 'l) tidak digunakan untuk fungsi K/L;',
                                'm' => 'm) disengketakan di pengadilan atau belum di pengadilan.',
                            ])
                            ->columnSpanFull(),
                        Select::make('condition')
                            ->label('Kondisi')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak Ringan' => 'Rusak Ringan',
                                'Rusak Berat' => 'Rusak Berat',
                            ])
                            ->nullable(),
                    ])
                    ->columns(2)
                    ->columnSpan(['sm' => 12, 'md' => 8]),

                Section::make('Harga & Info Tambahan')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        DatePicker::make('date')
                            ->label('Tanggal Perolehan')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('acquisition_price')
                            ->label('Harga Perolehan')
                            ->numeric()
                            ->prefix('Rp')
                            ->nullable(),
                        TextInput::make('current_price')
                            ->label('Nilai Saat Ini')
                            ->numeric()
                            ->prefix('Rp'),
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
                            ->directory('documentation/goods')
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
                TextColumn::make('id_bmn')
                    ->label('ID BMN')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Barang')
                    ->searchable(),
                TextColumn::make('nup')
                    ->label('NUP')
                    ->searchable(),
                TextColumn::make('brand')
                    ->label('Merek')
                    ->searchable(),
                TextColumn::make('group.name')
                    ->label('Kelompok')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('room.name')
                    ->label('Ruangan')
                    ->sortable(),
                TextColumn::make('condition')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Baik' => 'success',
                        'Rusak Ringan' => 'warning',
                        'Rusak Berat' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('date')
                    ->label('Tanggal Perolehan')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('acquisition_price')
                    ->label('Harga Perolehan')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('room')
                    ->label('Ruangan')
                    ->relationship('room', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Actions\Action::make('qrCode')
                    ->label('QR Code')
                    ->icon('heroicon-o-qr-code')
                    ->modalHeading(fn (Good $record) => "QR Code: {$record->id_bmn}")
                    ->modalContent(fn (Good $record) => view('filament.actions.qr-code', [
                        'url' => route('public.good.detail', $record),
                        'label' => $record->id_bmn,
                    ]))
                    ->modalSubmitAction(false),
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
            RelationManagers\MaintenancesRelationManager::class,
            RelationManagers\BorrowsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGoods::route('/'),
            'create' => Pages\CreateGood::route('/create'),
            'edit' => Pages\EditGood::route('/{record}/edit'),
        ];
    }
}

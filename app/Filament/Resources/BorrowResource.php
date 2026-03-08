<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BorrowResource\Pages;
use App\Models\Borrow;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Actions;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class BorrowResource extends Resource
{
    protected static ?string $model = Borrow::class;

    protected static ?string $modelLabel = 'Peminjaman';
    protected static ?string $pluralModelLabel = 'Peminjaman';
    protected static ?string $navigationLabel = 'Peminjaman';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-arrow-path';

    protected static string | UnitEnum | null $navigationGroup = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Peminjaman')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextInput::make('officer')
                            ->label('Petugas')
                            ->nullable()
                            ->maxLength(255),
                        Select::make('status')
                            ->label('Status Persetujuan')
                            ->options([
                                'pending' => 'Menunggu Persetujuan',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'returned' => 'Dikembalikan',
                            ])
                            ->default('pending')
                            ->required(),
                        TextInput::make('need')
                            ->label('Keperluan')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('borrow_date')
                            ->label('Tanggal Pinjam')
                            ->live()
                            ->required(),
                        DatePicker::make('return_date')
                            ->label('Tanggal Kembali (Perkiraan)')
                            ->live(),
                        Textarea::make('note')
                            ->label('Catatan')
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Barang yang Dipinjam')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('borrowGoods')
                            ->relationship()
                            ->schema([
                                Select::make('good_id')
                                    ->label('Barang')
                                    ->options(function (Get $get, $record) {
                                        $ignoreBorrowId = null;
                                        if ($record instanceof \App\Models\Borrow) {
                                            $ignoreBorrowId = $record->id;
                                        } elseif ($record instanceof \App\Models\BorrowGood) {
                                            $ignoreBorrowId = $record->borrow_id;
                                        }
                                        $borrowedGoodIds = self::getBorrowedGoodIds($get('../../borrow_date'), $get('../../return_date'), $ignoreBorrowId);
                                        return \App\Models\Good::all()->mapWithKeys(function ($good) use ($borrowedGoodIds) {
                                            $label = $good->full_name;
                                            if (in_array($good->id, $borrowedGoodIds)) {
                                                $label .= ' (Sedang Dipinjam)';
                                            }
                                            return [$good->id => $label];
                                        });
                                    })
                                    ->disableOptionWhen(function (string $value, Get $get, $record) {
                                        $ignoreBorrowId = null;
                                        if ($record instanceof \App\Models\Borrow) {
                                            $ignoreBorrowId = $record->id;
                                        } elseif ($record instanceof \App\Models\BorrowGood) {
                                            $ignoreBorrowId = $record->borrow_id;
                                        }
                                        $borrowedGoodIds = self::getBorrowedGoodIds($get('../../borrow_date'), $get('../../return_date'), $ignoreBorrowId);
                                        return in_array($value, $borrowedGoodIds);
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->columnSpanFull(),
                                Textarea::make('borrow_condition')
                                    ->label('Kondisi Saat Dipinjam')
                                    ->required()
                                    ->rows(2),
                                Textarea::make('return_condition')
                                    ->label('Kondisi Saat Kembali')
                                    ->rows(2),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['good_id'] ?? null)
                            ->addActionLabel('Tambah Barang')
                    ])
                    ->columnSpanFull(),

                Section::make('Detail Peminjam')
                    ->icon('heroicon-o-user')
                    ->description('Detail peminjam internal atau eksternal.')
                    ->schema([
                        Radio::make('borrower_type')
                            ->label('Tipe Peminjam')
                            ->options([
                                'internal' => 'Internal',
                                'external' => 'External',
                            ])
                            ->default('internal')
                            ->live()
                            ->required()
                            ->columnSpanFull(),

                        Select::make('borrower')
                            ->label('Peminjam (Internal)')
                            ->options(User::pluck('name', 'name'))
                            ->searchable()
                            ->required()
                            ->visible(fn (Get $get) => $get('borrower_type') === 'internal')
                            ->columnSpanFull(),

                        TextInput::make('borrower')
                            ->label('Nama Peminjam Eksternal')
                            ->required()
                            ->maxLength(255)
                            ->visible(fn (Get $get) => $get('borrower_type') === 'external')
                            ->columnSpanFull(),
                        TextInput::make('borrower_phone')
                            ->label('Telepon Peminjam')
                            ->tel()
                            ->maxLength(255)
                            ->visible(fn (Get $get) => $get('borrower_type') === 'external')
                            ->required(fn (Get $get) => $get('borrower_type') === 'external')
                            ->columnSpanFull(),
                        TextInput::make('borrower_email')
                            ->label('Email Peminjam')
                            ->email()
                            ->maxLength(255)
                            ->visible(fn (Get $get) => $get('borrower_type') === 'external')
                            ->required(fn (Get $get) => $get('borrower_type') === 'external')
                            ->columnSpanFull(),
                        Textarea::make('borrower_address')
                            ->label('Alamat Peminjam')
                            ->rows(3)
                            ->visible(fn (Get $get) => $get('borrower_type') === 'external')
                            ->required(fn (Get $get) => $get('borrower_type') === 'external')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Dokumentasi')
                    ->icon('heroicon-o-document-duplicate')
                    ->schema([
                        FileUpload::make('application_letter')
                            ->label('Surat Permohonan')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxFiles(1)
                            ->maxSize(10240)
                            ->directory('documentation/borrows/application_letter')
                            ->columnSpanFull(),
                        FileUpload::make('borrow_documentation')
                            ->label('Dokumentasi Peminjaman')
                            ->multiple()
                            ->maxFiles(4)
                            ->maxSize(10240)
                            ->acceptedFileTypes([
                                'image/jpeg', 'image/png', 'image/webp',
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ])
                            ->directory('documentation/borrows/borrow')
                            ->panelLayout('grid')
                            ->columnSpanFull(),
                        FileUpload::make('return_documentation')
                            ->label('Dokumentasi Pengembalian')
                            ->multiple()
                            ->maxFiles(4)
                            ->maxSize(10240)
                            ->acceptedFileTypes([
                                'image/jpeg', 'image/png', 'image/webp',
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ])
                            ->directory('documentation/borrows/return')
                            ->panelLayout('grid')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('goods.id_bmn')
                    ->label('Barang yang Dipinjam (ID BMN)')
                    ->badge()
                    ->separator(',')
                    ->searchable(),
                TextColumn::make('officer')
                    ->label('Petugas')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status Persetujuan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'returned' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu Persetujuan',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'returned' => 'Dikembalikan',
                        default => $state,
                    }),
                TextColumn::make('borrower')
                    ->label('Peminjam')
                    ->searchable(),
                TextColumn::make('borrower_type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'internal' => 'info',
                        'external' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('borrow_date')
                    ->label('Tanggal Pinjam')
                    ->date()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->label('Tanggal Kembali (Perkiraan)')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListBorrows::route('/'),
            'create' => Pages\CreateBorrow::route('/create'),
            'edit' => Pages\EditBorrow::route('/{record}/edit'),
        ];
    }

    public static function getBorrowedGoodIds(?string $borrowDate, ?string $returnDate, ?int $ignoreBorrowId): array
    {
        static $cache = [];
        $key = ($borrowDate ?? '') . '|' . ($returnDate ?? '') . '|' . ($ignoreBorrowId ?? '');

        if (array_key_exists($key, $cache)) {
            return $cache[$key];
        }

        if (!$borrowDate || !$returnDate) {
            return $cache[$key] = [];
        }

        $overlappingQuery = \App\Models\Borrow::whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($borrowDate, $returnDate) {
                $query->where('borrow_date', '<=', $returnDate)
                      ->where('return_date', '>=', $borrowDate);
            });

        if ($ignoreBorrowId) {
            $overlappingQuery->where('id', '!=', $ignoreBorrowId);
        }

        $cache[$key] = $overlappingQuery->with('borrowGoods')->get()->flatMap->borrowGoods->pluck('good_id')->toArray();

        return $cache[$key];
    }
}

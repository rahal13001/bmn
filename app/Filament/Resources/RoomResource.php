<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Actions;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $modelLabel = 'Ruangan';
    protected static ?string $pluralModelLabel = 'Ruangan';
    protected static ?string $navigationLabel = 'Ruangan';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-building-office';

    protected static string | UnitEnum | null $navigationGroup = 'Data Induk';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Ruangan')
                    ->icon('heroicon-o-information-circle')
                    ->description('Informasi dasar mengenai ruangan.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Ruangan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('dimension')
                            ->label('Dimensi/Ukuran')
                            ->maxLength(255),
                        Toggle::make('status')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(2)
                    ->columnSpan(['sm' => 12, 'md' => 8]),

                Section::make('Informasi Tambahan')
                    ->icon('heroicon-o-document-text')
                    ->schema([
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
                            ->directory('documentation/rooms')
                            ->panelLayout('grid')
                            ->columnSpanFull(),
                        Textarea::make('note')
                            ->label('Catatan')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(['sm' => 12, 'md' => 4]),
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Ruangan')
                    ->searchable(),
                IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('dimension')
                    ->label('Dimensi/Ukuran'),
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
                Actions\Action::make('qrCode')
                    ->label('Kode QR')
                    ->icon('heroicon-o-qr-code')
                    ->modalHeading(fn (Room $record) => "Kode QR: {$record->name}")
                    ->modalContent(fn (Room $record) => view('filament.actions.qr-code', [
                        'url' => route('public.room.inventory', $record),
                        'label' => $record->name,
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
            RelationManagers\GoodsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}

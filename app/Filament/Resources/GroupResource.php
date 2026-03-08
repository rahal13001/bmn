<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Filament\Resources\GroupResource\RelationManagers;
use App\Models\Group;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $modelLabel = 'Kelompok';
    protected static ?string $pluralModelLabel = 'Kelompok';
    protected static ?string $navigationLabel = 'Kelompok';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | UnitEnum | null $navigationGroup = 'Data Induk';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Kelompok')
                    ->icon('heroicon-o-information-circle')
                    ->description('Informasi dasar mengenai kelompok.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kelompok')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('brand')
                            ->label('Merek')
                            ->maxLength(255),
                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
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
                            ->directory('documentation/groups')
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
                    ->label('Nama Kelompok')
                    ->searchable(),
                TextColumn::make('brand')
                    ->label('Merek')
                    ->searchable(),
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
            RelationManagers\GoodsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}

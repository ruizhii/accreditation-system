<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgrammeStandardResource\Pages;
use App\Filament\Resources\ProgrammeStandardResource\RelationManagers;
use App\Models\ProgrammeStandard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgrammeStandardResource extends Resource
{
    protected static ?string $model = ProgrammeStandard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('academic_programme_id')
                    ->relationship('academic_programme', 'name')
                    ->required()
                    ->native(false),
                Forms\Components\FileUpload::make('document_path')
                    ->label('Upload the Programme Standards (Part C)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('academic_programme.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_path')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListProgrammeStandards::route('/'),
            'create' => Pages\CreateProgrammeStandard::route('/create'),
            'edit' => Pages\EditProgrammeStandard::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicProgrammeResource\Pages;
use App\Filament\Resources\AcademicProgrammeResource\RelationManagers;
use App\Models\AcademicProgramme;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AcademicProgrammeResource extends Resource
{
    protected static ?string $model = AcademicProgramme::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('faculty_id')
                    ->relationship('faculty', 'name')
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('graduate_level')
                    ->required()
                    ->options([
                        'undergraduate' => 'Undergraduate',
                        'postgraduate' => 'Postgraduate',
                    ])
                    ->native(false),
                Forms\Components\Select::make('study_mode')
                    ->required()
                    ->options([
                        'course_work' => 'Course Work',
                        'clinical' => 'Clinical',
                    ])
                    ->native(false),
                Forms\Components\TextInput::make('nec_2010')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nec_2020')
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_semester')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('max_semester')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('required_graduation_credit')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('degree_qualification_type')
                    ->required()
                    ->options([
                        'homegrown' => 'Homegrown',
                        'professional' => 'Professional',
                    ])
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('faculty.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('graduate_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('study_mode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nec_2010')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nec_2020')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_semester')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_semester')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('required_graduation_credit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('degree_qualification_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListAcademicProgrammes::route('/'),
            'create' => Pages\CreateAcademicProgramme::route('/create'),
            'edit' => Pages\EditAcademicProgramme::route('/{record}/edit'),
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

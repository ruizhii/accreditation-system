<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacultyResource\Pages;
use App\Filament\Resources\FacultyResource\RelationManagers;
use App\Models\Faculty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacultyResource extends Resource
{
    protected static ?string $model = Faculty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $year = 1;
        return $form
            ->columns(4)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('director_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('director_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tel')
                    ->label('Faculty telephone number')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('fax')
                    ->label('Faculty fax number')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('website')
                    ->label('Website')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Section::make('Departments/Centres')
                    ->description('Lists departments/centres in the faculty (and its branch campuses) and number of programmes offered')
                    ->schema([
                        Forms\Components\Repeater::make('department')
                            ->columns(3)
                            ->statePath('department')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Name of Departments/Centres')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('location')
                                    ->required()
                                    ->label('Location (On campus/Off campus)')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('no_programmes')
                                    ->required()
                                    ->label('Number of Programmes Offered')
                                    ->integer()
                                    ->maxLength(255),
                            ])
                    ]),

                Forms\Components\Section::make('Total number of academic staff')
                    ->statePath('academic_staff')
                    ->schema([
                        Forms\Components\Section::make('full-time')
                            ->statePath('full-time')
                            ->schema([
                                Forms\Components\Section::make('malaysian')
                                    ->statePath('malaysian')
                                    ->columns(6)
                                    ->schema([
                                        Forms\Components\TextInput::make('doctoral')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('masters')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('bachelors')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('diploma')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('certificate')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('others')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),    
                                        ]),
                                Forms\Components\Section::make('non-malaysian')
                                    ->statePath('non-malaysian')
                                    ->columns(6)
                                    ->schema([
                                        Forms\Components\TextInput::make('doctoral')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('masters')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('bachelors')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('diploma')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('certificate')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('others')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),    
                                        ]),
                                        ]),
                        Forms\Components\Section::make('part-time')
                            ->statePath('part-time')
                            ->schema([
                                Forms\Components\Section::make('malaysian')
                                    ->statePath('malaysian')
                                    ->columns(6)
                                    ->schema([
                                        Forms\Components\TextInput::make('doctoral')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('masters')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('bachelors')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('diploma')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('certificate')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('others')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),    
                                        ]),
                                Forms\Components\Section::make('non-malaysian')
                                    ->statePath('non-malaysian')
                                    ->columns(6)
                                    ->schema([
                                        Forms\Components\TextInput::make('doctoral')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('masters')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('bachelors')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('diploma')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('certificate')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),
                                        Forms\Components\TextInput::make('others')
                                            ->integer()
                                            ->required()
                                            ->maxLength(5),    
                                        ]),
                                ]),
                    ]),
                       

                Forms\Components\Section::make('Number of student')
                    ->description('Total number of student')
                    ->statePath('no_student')
                    ->columns(2)
                    ->reactive()
                    ->schema([
                    Forms\Components\TextInput::make('local_male')
                        ->label("Number of local male student")    
                        ->integer()
                        ->required()
                        ->maxLength(6),
                    Forms\Components\TextInput::make('local_female')
                        ->label("Number of local female student")
                        ->integer()
                        ->required()
                        ->maxLength(6),
                    Forms\Components\TextInput::make('international_male')
                        ->label("Number of international male student")
                        ->integer()
                        ->required()
                        ->maxLength(6),
                    Forms\Components\TextInput::make('international_female')
                        ->label("Number of international female student")
                        ->integer()
                        ->required()
                        ->maxLength(6),
                    Forms\Components\TextInput::make('disabled_male')
                        ->label("Number of disabled male student")
                        ->integer()
                        ->required()
                        ->maxLength(6),
                    Forms\Components\TextInput::make('disabled_female')
                        ->label("Number of disabled female student")
                        ->integer()
                        ->required()
                        ->maxLength(6),
                    ]),
                    Forms\Components\Card::make([
                        Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Placeholder::make("total_male_student")
                                ->label("Total number of male student")
                                ->content(function ($get) {
                                    $total_male = 0;
                                    $local_male = $get('no_student.local_male');
                                    $international_male = $get('no_student.international_male');
                                    if($local_male != null && $international_male != null)
                                    $total_male = $local_male + $international_male;
                                    return $total_male;
                                }),
                            Forms\Components\Placeholder::make("total_female_student")
                                ->label("Total number of female student")
                                ->content(function ($get) {
                                    $total_female = 0;
                                    $local_female = $get('no_student.local_female');
                                    $international_female = $get('no_student.international_female');
                                    if($local_female != null && $international_female != null)
                                    $total_female = $local_female + $international_female;
                                    return $total_female;
                                }),
                            Forms\Components\Placeholder::make("total_local_student")
                                ->label("Total number of local student")
                                ->content(function ($get) {
                                    $total_local = 0;
                                    $local_male = $get('no_student.local_male');
                                    $local_female = $get('no_student.local_female');
                                    if($local_male != null && $local_female != null)
                                    $total_local = $local_male + $local_female;
                                    return $total_local;
                                }),
                            Forms\Components\Placeholder::make("total_international_student")
                                ->label("Total number of international student")
                                ->content(function ($get) {
                                    $total_international = 0;
                                    $international_male = $get('no_student.international_male');
                                    $international_female = $get('no_student.international_female');
                                    if($international_male != null && $international_female != null)
                                    $total_international = $international_male + $international_female;
                                    return $total_international;
                                }),
                                Forms\Components\Placeholder::make("total_disabled_student")
                                ->label("Total number of disabled student")
                                ->content(function ($get) {
                                    $total_disabled = 0;
                                    $disabled_male = $get('no_student.disabled_male');
                                    $disabled_female = $get('no_student.disabled_female');
                                    if($disabled_male != null && $disabled_female != null)
                                    $total_disabled = $disabled_male + $disabled_female;
                                    return $total_disabled;
                                }),
                                Forms\Components\Placeholder::make("total_student")
                                ->label("Total number of student")
                                ->content(function ($get) {
                                    $total_student = 0;
                                    $local_male = $get('no_student.local_male');
                                    $local_female = $get('no_student.local_female');
                                    $international_male = $get('no_student.international_male');
                                    $international_female = $get('no_student.international_female');
                                    if($local_male != null && $international_male != null && $local_female && $international_female)
                                    $total_student = $local_male + $local_female + $international_male + $international_female;
                                    return $total_student;
                                })
                        ]),
                    ])->columnSpan(2),
                
                Forms\Components\Section::make('Student attrition')
                    ->description('')
                    ->reactive()
                    ->schema([
                        Forms\Components\Repeater::make('student_attrition')
                            ->columns(2)
                            ->defaultItems(3)
                            ->disableItemCreation()
                            ->disableItemDeletion()
                            ->disableItemMovement()
                            ->statePath('student_attrition')
                            ->schema([
                                Forms\Components\TextInput::make('year')
                                    ->required()
                                    ->maxLength(4),
                                Forms\Components\TextInput::make('total_student')
                                    ->required()
                                    ->reactive()
                                    ->integer(),
                                Forms\Components\TextInput::make('no_dropout')
                                    ->required()
                                    ->integer(),
                                Forms\Components\Placeholder::make('attrition_rate')
                                    ->content(function ($get) {
                                        $attrition_rate = 0;
                                        $total_student = $get('total_student');
                                        $no_dropout = $get('no_dropout');
                                        if($total_student != null && $no_dropout != null)
                                        $attrition_rate = ($no_dropout/$total_student)*100;
                                        return $attrition_rate;
                                    }),
                                Forms\Components\TextInput::make('leave_reason')
                                    ->required(),   
                            ])
                        
                            
                    ]),  
                    
                Forms\Components\Section::make('Administrative Staff')
                    ->description('Total number of administrative and support staff')
                    ->schema([
                        Forms\Components\Repeater::make('administrative_staff')
                            ->columns(2)
                            ->defaultItems(2)
                            ->statePath('administrative_staff')
                            ->schema([
                                Forms\Components\TextInput::make('classification')
                                    ->required()
                                    ->label('Classification by Function')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('no_staff')
                                    ->required()
                                    ->label('Number of Administrative and Support staff')
                                    ->numeric(),
                            ])
                        
                            
                    ]),

                Forms\Components\Section::make('Annual Allocation')
                    ->description('Add annual allocation of the faculty for the last three consecutive years')
                    ->schema([
                        Forms\Components\Repeater::make('annual_allocation')
                            ->columns(2)
                            ->defaultItems(3)
                            ->disableItemCreation()
                            ->disableItemDeletion()
                            ->disableItemMovement()
                            ->statePath('annual_allocation')
                            ->schema([
                                Forms\Components\TextInput::make('year')
                                    ->required()
                                    ->maxLength(4),
                                Forms\Components\TextInput::make('value')
                                    ->required(),
                            ])
                        
                            
                    ]),
                Forms\Components\FileUpload::make('organizational_chart')
                ->label('Latest Faculty Organisational Chart'),
                
                Forms\Components\Section::make('Programme Leader')
                    ->description('Details of Programme Leader (Timbalan Dekan/Timbalan Pengarah')
                    ->statePath('programme_leader')
                    ->schema([
                        Forms\Components\TextInput::make('name_title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('designation')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tel')
                            ->required()
                            ->maxLength(15),
                        Forms\Components\TextInput::make('fax')
                            ->required()
                            ->maxLength(15),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->maxLength(255),
                    ])

            ]);
            
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('director_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('director_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fax')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
/*                Tables\Columns\TextColumn::make('department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('academic_staff')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_student')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student_attrition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('administrative_staff')
                    ->searchable(),
                Tables\Columns\TextColumn::make('annual_allocation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('organizational_chart')
                    ->searchable(),    
                Tables\Columns\TextColumn::make('programme_leader')
                    ->searchable(),   */
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
            'index' => Pages\ListFaculties::route('/'),
            'create' => Pages\CreateFaculty::route('/create'),
            'edit' => Pages\EditFaculty::route('/{record}/edit'),
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

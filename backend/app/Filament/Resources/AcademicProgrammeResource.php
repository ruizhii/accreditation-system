<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicProgrammeResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Models\AcademicProgramme;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\Cast\Array_;
use Filament\Tables\Filters\SelectFilter;

class AcademicProgrammeResource extends Resource
{
    protected static ?string $model = AcademicProgramme::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mqf_level'),   //Need sample
                Forms\Components\TextInput::make('mqr_no'),   //Need sample
                Forms\Components\TextInput::make('required_graduating_credit'),   //Need sample 
                Forms\Components\Section::make('Accredited by UM')
                    ->description('Has this programme been accredited by UM for other premises? If yes, please provide the following details:')
                    ->schema([
                        Forms\Components\Repeater::make('accredited_um')
                            ->columns(2)
                            ->defaultItems(0)
                            ->disableItemMovement()
                            ->statePath('accredited_um')
                            ->schema([
                                Forms\Components\TextInput::make('name_location')
                                    ->label(__('Name and Location of the Premises (main campus/ branch campuses/ regional centre)'))
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('delivery_mode')
                                    ->label(__('Mode of Delivery')),
                                Forms\Components\TextInput::make('provisional_accreditation_status')
                                    ->label(__('Accreditation Status (Provisional)')),
                                Forms\Components\TextInput::make('full_accreditation_status')
                                    ->label(__('Accreditation Status (Full)')),
                            ])  
                    ]),  
                       
                Forms\Components\Select::make('award_type')
                    ->options([
                        'single_major' => 'Single Major',
                        'double_major' => 'Double Major',
                    ])
                    ->native(false),
                Forms\Components\TextInput::make('old_nec')
                    ->maxLength(255),
                Forms\Components\TextInput::make('new_nec')
                    ->maxLength(255),
                Forms\Components\TextInput::make('location_conducted')
                    ->maxLength(255),
                Forms\Components\Select::make('instruction_language')
                    ->options([
                        'english' => 'English',
                        'malay' => 'Bahasa Malaysia',
                    ])
                    ->native(false),
                Forms\Components\Select::make('programme_type')
                    ->options([
                        'collaboration' => 'Collaboration',
                        'homegrown' => 'Homegrown',
                        'external_programme' => 'External Programme',
                        'joint_award' => 'Joint Award',
                        'joint_gegree' => 'Joint Gegree',
                    ])
                    ->native(false),
                Forms\Components\Select::make('study_mode')
                    ->options([
                        'full_time' => 'full-time',
                        'part_time' => 'part-time',
                    ])
                    ->native(false),
                Forms\Components\Select::make('graduate_level')
                    ->options([
                        'undergraduate' => 'Undergraduate',
                        'postgraduate' => 'Postgraduate',
                    ])
                    ->reactive(),
                Forms\Components\Select::make('offer_mode')
                    ->label('Mode of study')
                    ->options(function (callable $get) {
                        $graduate_level = $get('graduate_level');
                        
                        if ($graduate_level == 'undergraduate') {
                            return [
                                'coursework' => 'Coursework',
                                'industry_mode' => 'Industry Mode (2u2i)',
                            ];
                        } else {
                            return [
                                'coursework' => 'Coursework',
                                'mixed_mode' => 'Mixed mode',
                                'research' => 'Research',
                            ];
                        }
                    }),
                Forms\Components\Select::make('teaching_method')   
                    ->multiple()
                    ->options([
                        'lecture' => 'Lecture',
                        'tutorial' => 'Tutorial',
                        'lab' => 'Lab',
                        'fieldwork' => 'Fieldwork',
                        'studio' => 'Studio',
                        'blended_learning' => 'Blended Learning',
                        'e-learning' => 'E-learning',
                    ]),
                Forms\Components\CheckboxList::make('delivery_mode')  
                    ->options([
                        'conventional' => 'Conventional (tradional, online and blended leraning',
                        'odl' => 'Open and Distance Learning (ODL)',
                    ]),
                Forms\Components\TextInput::make('study_duration')
                    ->maxLength(255)
                    ->numeric()
                    ->suffix('Sem'),
                Forms\Components\DatePicker::make('first_intake_date')
                    ->minDate(now()->subYears(150))
                    ->maxDate(now())
                    ->displayFormat('d/m/Y'),
                Forms\Components\Section::make('Student Enrolment')
                    ->description('Total intake and enrolment of student (Current session)')
                    ->schema([
                        Forms\Components\Repeater::make('student_enrolment')
                            ->columns(7)
                            ->defaultItems(0)
                            ->disableItemMovement()
                            ->statePath('student_enrolment')
                            ->schema([
                                Forms\Components\TextInput::make('year')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('intake_upu')
                                    ->label(__('Intake UPU'))
                                    ->numeric(),
                                Forms\Components\TextInput::make('intake_satu')
                                    ->label(__('Intake SATU'))
                                    ->numeric(),
                                Forms\Components\TextInput::make('intake_rl')
                                    ->label(__('Intake RL'))
                                    ->numeric(),
                                Forms\Components\TextInput::make('enrolment_upu')
                                    ->label(__('Enrolment UPU'))
                                    ->numeric(),
                                Forms\Components\TextInput::make('enrolment_satu')
                                    ->label(__('Enrolment SATU'))
                                    ->numeric(),
                                Forms\Components\TextInput::make('enrolment_rl')
                                    ->label(__('Enrolment RL'))
                                    ->numeric(),
                            ])
                            ->minItems(1)
                            ->defaultItems(2)
                            ->createItemButtonLabel('Add year')
                            ->grid(1),     
                    ]),
                Forms\Components\DatePicker::make('graduation_date')
                    ->label(__('Estimated date of first graduation (after the latest curriculum review)'))
                    ->minDate(now()->subYears(150))
                    ->maxDate(now())
                    ->displayFormat('d/m/Y'),   
                Forms\Components\TagsInput::make('graduate_job_type')
                    ->columns(1)
                    ->placeholder('Type and ENTER')
                    ->suggestions([
                        'TO DO',
                    ]),
                Forms\Components\Tabs::make('Awarding Body')
                    ->statePath('awarding_body')
                    ->columnSpanFull()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Label 1')
                            ->schema([
                                Forms\Components\Radio::make('type')
                                    ->label('Choose')
                                    ->reactive()
                                    ->options([
                                        'own' => 'Own',
                                        'others' => 'Others (Please name)',
                                    ])
                                    ->descriptions([
                                        'others' => '(Please attach the relevant documents, where applicable)',
                                    ]),
                                    Forms\Components\TextInput::make('name')
                                        ->maxLength(255)
                                        ->hidden(function (callable $get) {
                                            $type = $get('type');
                                
                                            if ($type == 'own' || $type == null) {
                                                return TRUE;
                                            } else {
                                                return FALSE;
                                            }
                                        },
                                        ),
                            ]),
                        Forms\Components\Tabs\Tab::make('Label 2')
                            ->schema([
                                Forms\Components\FileUpload::make('hep_collab_proof')
                                    ->label('Relevant document')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('custom-prefix-'),
                                    ),
                                Forms\Components\FileUpload::make('jpt_approval_letter')
                                    ->label('Relevant document')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('custom-prefix-'),
                                    ),
                                Forms\Components\FileUpload::make('programme_approval_proof')
                                    ->label('Relevant document')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('custom-prefix-'),
                                    ),
                                Forms\Components\FileUpload::make('programme_specification_copy')
                                    ->label('Relevant document')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('custom-prefix-'),
                                    ),
                                Forms\Components\FileUpload::make('quality_partners_collab_proof')
                                    ->label('Relevant document')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('custom-prefix-'),
                                    ),
                                Forms\Components\FileUpload::make('clinical_training_approval_proof')
                                    ->label('Relevant document')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                            ->prepend('custom-prefix-'),
                                    ),
                                Forms\Components\Repeater::make('student_enrolment')
                                    ->columns(7)
                                    ->defaultItems(0)
                                    ->disableItemMovement()
                                    ->statePath('other_documents')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('attachment')
                                            ->label('Relevant document')
                                            ->getUploadedFileNameForStorageUsing(
                                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                                    ->prepend('custom-prefix-'),
                                            ),
                                    ])
                                    ->createItemButtonLabel('Add other relevant document')
                                    ->grid(2),
                            ])
                            ->hidden(function (callable $get) {
                                $type = $get('type');
                                
                                if ($type == 'own' || $type == null) {
                                    return TRUE;
                                } else {
                                    return FALSE;
                                }
                            },
                            ),
                    ]),
                
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\FileUpload::make('scroll_awarded')   
                            ->label('Provide a sample of scroll awarded')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend('custom-prefix-'),
                            ),
                        Forms\Components\DatePicker::make('accurate_as_of')
                            ->label(__('Data provided accurate as of'))
                            ->minDate(now()->subYears(150))
                            ->maxDate(now())
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Programme Coordinator')
                    ->description('Details of Programme Coordinator/ Administrative Manager')
                    ->statePath('programme_coordinator')
                    ->schema([
                        Forms\Components\TextInput::make('name_title')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('designation')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tel')
                            ->maxLength(15),
                        Forms\Components\TextInput::make('fax')
                            ->maxLength(15),
                        Forms\Components\TextInput::make('email')
                            ->maxLength(255),
                    ])
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

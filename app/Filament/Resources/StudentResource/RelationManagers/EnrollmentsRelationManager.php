<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

// form fields
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;


// table columns
use Filament\Tables\Columns\TextColumn;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollment';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')
                ->relationship('course', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->createOptionForm([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('credit_hour')->required()->numeric(),
                ]),
                
                Select::make('semester_id')
                ->relationship('semester', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->createOptionForm([
                    TextInput::make('name')->required()->maxLength(255),
                    DatePicker::make('start_date')->required()->maxDate(now()),
                    DatePicker::make('end_date')->required(),
                ]),

                TextInput::make('score')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ,
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Grade')
            ->columns([
                TextColumn::make('semester.name')->label("Semester"),
                TextColumn::make('semester.semester_gpa')->label("Semester GPA"),
                TextColumn::make('course.name')->label("Course"),
                TextColumn::make('score')->label("Score"),
                TextColumn::make('grade_point')->label("Grade Point"),
                TextColumn::make('grade')->label("Grade"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

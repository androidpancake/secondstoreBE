<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Products;
use App\Models\Categories;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;

class ProductResource extends Resource
{
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public Categories $categories;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Product Information')
                    ->schema([
                        TextInput::make('title')->required()->maxLength(50),
                        TextInput::make('description')->required(),
                        TextInput::make('price')->numeric(),
                        DatePicker::make('year')->format('Y')->displayFormat('Y')->maxDate(now())->native(false),
                        Select::make('condition')->options([
                            'second' => 'Second',
                            'new' => 'New'
                        ]),

                        Textarea::make('defect'),
                        TextInput::make('stock')->numeric(),
                        Toggle::make('is_popular')->label('Is Popular?'),
                        Select::make('category_id')
                        ->relationship(name: 'categories', titleAttribute: 'name')
                    ]),
                Section::make('Image')
                    ->description('image')
                    ->schema([
                        Repeater::make('image')
                            ->relationship('productImage')
                            ->schema([
                                FileUpload::make('image')->required()
                            ]),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Title'),
                TextColumn::make('price')->label('Price'),
                TextColumn::make('stock')->label('Stock'),
                TextColumn::make('year')->label('Year')

            ])
            ->filters([
                Filter::make('title')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

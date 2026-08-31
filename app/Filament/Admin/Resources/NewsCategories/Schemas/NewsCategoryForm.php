<?php

namespace App\Filament\Admin\Resources\NewsCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Illuminate\Support\Str;

use Filament\Schemas\Schema;

class NewsCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $slug = Str::slug($state);

                        $set('slug', $slug);
                    }),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Textarea::make('description')
                    ->rows(3)
                    ->maxlength(1000)
                    ->default(null),

                Toggle::make('is_active')
                    ->required(),

                TextInput::make('sort_order')
                    ->numeric(),
            ]);
    }
}

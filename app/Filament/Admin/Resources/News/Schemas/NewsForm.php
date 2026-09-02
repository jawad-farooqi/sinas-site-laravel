<?php

namespace App\Filament\Admin\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()    
                    ->minLength(3)
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                                $set(
                                    'slug',
                                    \Illuminate\Support\Str::slug($state)
                                );
                            }),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                
                Textarea::make('excerpt')
                            ->label('Short Summary')
                            ->required()
                            ->maxLength(500)
                            ->rows(4)
                            ->columnSpanFull()
                            ->columns(2)
                            ->columnSpanFull(),

                Textarea::make('content')
                    ->default(null)
                    ->columnSpanFull(),

                Select::make('news_category_id')
                    ->label('Category')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->where('is_active', true)
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                FileUpload::make('featured_image')
                    ->image(),

                Select::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])
                    ->default('draft')
                    ->required(),
                    
                DateTimePicker::make('published_at'),
                DateTimePicker::make('expires_at'),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('author_id')
                    ->numeric()
                    ->default(null),

                Repeater::make('attachments')
                    ->relationship()
                    ->label('Attachments')
                    ->schema([
                        FileUpload::make('file_path')
                            ->label('File')
                            ->required()
                            ->maxSize(10240)
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ])
                            ->directory('news/attachments')
                            ->downloadable()
                            ->openable(),

                        TextInput::make('original_name')
                            ->label('Display Name')
                            ->maxLength(255)
                            ->helperText('Optional. Leave blank to use the uploaded filename.'),
                    ])
                    ->defaultItems(0)
                    ->addActionLabel('Add Attachment')
                    ->reorderable()
                    ->collapsible()
                    ->columnSpanFull()

            ]);
    }
}

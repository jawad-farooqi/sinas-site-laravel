<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->minLength(3)
                    ->maxLength(100)
                    ->regex('/^[\pL\s]+$/u'),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->minLength(8)
                    ->maxLength(255)
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->same('password_confirmation')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),

                TextInput::make('password_confirmation')
                    ->password()
                    ->revealable()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(false),

                Select::make('role')
                    ->label('Role')
                    ->options(
                        Role::query()
                            ->pluck('name', 'name')
                            ->toArray()
                    )
                    ->default('viewer')
                    ->required()
                    ->searchable(),

                Toggle::make('is_active')
                    ->default(true)
                    ->required()
                    ->disabled(fn (?User $record): bool => $record?->id === auth()->id()),
            ]);  // End of components
    }
}

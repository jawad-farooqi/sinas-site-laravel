<?php

namespace App\Filament\Admin\Resources\Users;

use App\Filament\Admin\Resources\Users\Pages\CreateUser;
use App\Filament\Admin\Resources\Users\Pages\EditUser;
use App\Filament\Admin\Resources\Users\Pages\ListUsers;
use App\Filament\Admin\Resources\Users\Schemas\UserForm;
use App\Filament\Admin\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Only admins can view the Users resource in the Filament admin panel.
    public static function canViewAny(): bool 
    { 
        return auth()->user()?->hasRole('admin') ?? false; 
    }

    // Only admins can create new users in the Filament admin panel.
    public static function canCreate(): bool 
    { 
        return auth()->user()?->hasRole('admin') ?? false; 
    }

    // Only admins can edit users in the Filament admin panel.
    public static function canEdit($record): bool 
    { 
        return auth()->user()?->hasRole('admin') ?? false; 
    }

    // Only admins can delete users in the Filament admin panel.
    public static function canDelete($record): bool 
    { 
        return auth()->user()?->can('delete users') 
        && $record->id !== auth()->id();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
    
}

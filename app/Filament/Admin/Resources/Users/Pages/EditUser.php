<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    private ?string $selectedRole = null;

    protected function getHeaderActions(): array
    {
        return [
                DeleteAction::make() 
                    ->hidden( 
                        fn (User $record): bool => 
                            $record->id === auth()->id() 
                            || $record->can('manage all') 
                            || ! auth()->user()->can('delete users') 
                        ),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load the user's current Spatie role into the form. 
        $data['role'] = $this->record->getRoleNames()->first(); 
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Protected system user. 
        // Nothing about this account can be changed 
        // through the application. 
        if ($this->record->can('manage all')) 
            { 
                return [ 
                    'name' => $this->record->name, 
                    'email' => $this->record->email, 
                    'password' => $this->record->password, 
                    'is_active' => $this->record->is_active, 
                ]; 
            } 
            // Normal user: 
            // capture the selected role. 
            $this->selectedRole = $data['role'] ?? null; 
            unset($data['role']);
            
            // Nobody can change their own active status. 
            if ($this->record->id === auth()->id()) 
                { 
                    $data['is_active'] = $this->record->is_active; 
                } 
            return $data;
    }

    protected function afterSave(): void
    {
        if ($this->record->can('manage all')) 
            {
                return;
            }

        if ($this->selectedRole) 
            {
                $this->record->syncRoles([
                    $this->selectedRole
                ]);
            }
    }
}
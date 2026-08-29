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
                    fn (User $record): bool => $record->id === auth()->id()
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
        // Get the selected role. 
        $this->selectedRole = $data['role'] ?? null; 
        
        // 'role' is not a column in the users table. 
        unset($data['role']); 
        
        // Prevent users from changing their own active status. 
        if ($this->record->id === auth()->id()) 
        { 
            $data['is_active'] = $this->record->is_active; 
        } 

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->selectedRole) 
        { 
            $this->record->syncRoles([$this->selectedRole]); 
        }
    }
}
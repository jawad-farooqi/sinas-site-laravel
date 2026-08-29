<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    private ?string $selectedRole = null;

    protected function getRedirectUrl(): string 
    { 
        return $this->getResource()::getUrl('index'); 
    }

    protected function mutateFormDataBeforeCreate(array $data): array 
    { 
        // Get the selected role from the form. 
        
        $this->selectedRole = $data['role'] ?? 'viewer';

        // 'role' is NOT a column in the users table. 
        // Remove it before Filament creates the User. 
         
        unset($data['role']); return $data;
        
        return $data; 
    } 
    
    protected function afterCreate(): void 
    { 
        if (!empty($this->selectedRole)) 
            { 
                $this->record->assignRole($this->selectedRole); 
            } 
    } 
    
}

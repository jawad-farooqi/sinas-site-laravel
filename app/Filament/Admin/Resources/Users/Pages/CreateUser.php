<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array 
    { 
        // Get the selected role from the form. 
        
        $this->selectedRole = $this->form->getState()['role'] ?? 'viewer'; 
        
        return $data; 
    } 
    
    protected function afterCreate(): void 
    { 
        if (!empty($this->selectedRole)) 
            { 
                $this->record->assignRole($this->selectedRole); 
            } 
    } 
    
    private ?string $selectedRole = null;
}

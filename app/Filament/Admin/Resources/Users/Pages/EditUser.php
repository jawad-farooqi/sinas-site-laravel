<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

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
        // Show the user's current Spatie role in the edit form.
        $data['role'] = $this->record->getRoleNames()->first();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Prevent users from changing their own active status.
        if ($this->record->id === auth()->id()) {
            $data['is_active'] = $this->record->is_active;
        }

        return $data;
    }

    protected function afterSave(): void
    {
        // Get the selected role from the form.
        $role = $this->form->getState()['role'] ?? null;

        if ($role) {
            $this->record->syncRoles([$role]);
        }
    }
}
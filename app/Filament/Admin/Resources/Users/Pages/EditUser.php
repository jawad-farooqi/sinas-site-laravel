<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->hidden(fn (User $record): bool => $record->id === auth()->id()),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record->id === auth()->id()) {
            $data['is_active'] = $this->record->is_active;
        }

        return $data;
    }
}

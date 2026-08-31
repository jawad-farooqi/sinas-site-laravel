<?php

namespace App\Filament\Admin\Resources\NewsCategories\Pages;

use App\Filament\Admin\Resources\NewsCategories\NewsCategoryResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\NewsCategory;


class CreateNewsCategory extends CreateRecord
{
    protected static string $resource = NewsCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $lastSortOrder = NewsCategory::max('sort_order');

        $data['sort_order'] = ($lastSortOrder ?? 0) + 1;

        return $data;
    }
}

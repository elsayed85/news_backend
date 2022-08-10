<?php

namespace App\Filament\Resources\Video\CategoryResource\Pages;

use App\Filament\Resources\Video\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}

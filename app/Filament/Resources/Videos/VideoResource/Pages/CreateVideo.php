<?php

namespace App\Filament\Resources\Videos\VideoResource\Pages;

use App\Filament\Resources\Videos\VideoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;
}

<?php

namespace App\Filament\Resources\Videos\VideoResource\Pages;

use App\Filament\Resources\Videos\VideoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

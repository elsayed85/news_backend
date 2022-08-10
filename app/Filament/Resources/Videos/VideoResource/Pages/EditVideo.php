<?php

namespace App\Filament\Resources\Videos\VideoResource\Pages;

use App\Filament\Resources\Videos\VideoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVideo extends EditRecord
{
    protected static string $resource = VideoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Phpsa\FilamentAuthentication\Events\UserCreated;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public static function getResource(): string
    {
        return Config::get('filament-authentication.resources.UserResource');
    }

    protected function afterCreate(): void
    {
        Event::dispatch(new UserCreated($this->record));
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }
}

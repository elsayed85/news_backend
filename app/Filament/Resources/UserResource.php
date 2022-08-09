<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use \Phpsa\FilamentAuthentication\Resources\UserResource as BaseUserResource;
use Filament\Resources\Table;
use STS\FilamentImpersonate\Impersonate;
use Filament\Facades\Filament;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\BelongsToManyMultiSelect;
use Filament\Tables\Filters\TernaryFilter;
use Phpsa\FilamentAuthentication\Actions\ImpersonateLink;
use Phpsa\FilamentAuthentication\Resources\UserResource\Pages\EditUser;
use Phpsa\FilamentAuthentication\Resources\UserResource\Pages\ViewUser;
use Phpsa\FilamentAuthentication\Resources\UserResource\Pages\ListUsers;
use Phpsa\FilamentAuthentication\Resources\UserResource\Pages\CreateUser;

class UserResource extends BaseUserResource
{

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(strval(__('filament-authentication::filament-authentication.field.user.name')))
                            ->required(),
                        TextInput::make('username')
                            ->required()
                            ->unique(table: User::class, ignorable: fn (?User $record): ?User => $record)
                             ->label(strval(__('filament-authentication::filament-authentication.field.user.username'))),
                        TextInput::make('password')
                            ->same('passwordConfirmation')
                            ->password()
                            ->maxLength(255)
                            ->required(fn($component, $get, $livewire, $model, $record, $set, $state) =>  $record === null)
                            ->dehydrateStateUsing(fn ($state) => ! empty($state) ? Hash::make($state) : "")
                             ->label(strval(__('filament-authentication::filament-authentication.field.user.password'))),
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->dehydrated(false)
                            ->maxLength(255)
                             ->label(strval(__('filament-authentication::filament-authentication.field.user.confirm_password'))),
                        BelongsToManyMultiSelect::make('roles')
                            ->relationship('roles', 'name')
                             ->preload(config('filament-authentication.preload_roles'))
                             ->label(strval(__('filament-authentication::filament-authentication.field.user.roles')))
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(strval(__('filament-authentication::filament-authentication.field.id'))),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()->label(strval(__('filament-authentication::filament-authentication.field.user.name'))),
                TextColumn::make('username')
                    ->searchable()
                    ->sortable()->label(strval(__('filament-authentication::filament-authentication.field.user.username'))),
                // IconColumn::make('email_verified_at')
                //     ->options([
                //         'heroicon-o-check-circle',
                //         'heroicon-o-x-circle' => fn ($state): bool => $state === null,
                //     ])
                //     ->colors([
                //         'success',
                //         'danger' => fn ($state): bool => $state === null
                //     ])
                //     ->label(strval(__('filament-authentication::filament-authentication.field.user.verified_at'))),
                // IconColumn::make('roles')
                //     ->tooltip(
                //         fn (User $record): string => $record->getRoleNames()->implode(",\n")
                //     )->options(
                //         [
                //             'heroicon-o-shield-check'
                //         ]
                //     )->colors(['success']),
                TagsColumn::make('roles.name')
                    ->label(strval(__('filament-authentication::filament-authentication.field.user.roles'))),
                TextColumn::make('created_at')
                    ->dateTime("Y-m-d H:i:s")
                    ->label(strval(__('filament-authentication::filament-authentication.field.user.created_at')))
            ])
            ->filters([
                // TernaryFilter::make('email_verified_at')
                //     ->label(strval(__('filament-authentication::filament-authentication.filter.verified')))
                //     ->nullable(),

            ])
            ->prependActions([
                ImpersonateLink::make()
            ]);
    }

}

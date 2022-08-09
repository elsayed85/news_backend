<?php

namespace App\Filament\Pages\FilamentAuthentication;

use Filament\Pages\Page;
use Filament\Facades\Filament;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\Rules\Password;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Database\Eloquent\Model;

/**
 * @TODO - fix translations
 * @property \Filament\Forms\ComponentContainer $form
 */
class Profile extends Page
{
    use InteractsWithForms;

    protected static string $view = 'filament-authentication::filament.pages.profile';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * @var array<string, string>
     */
    public array $formData;

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getFormStatePath(): string
    {
        return 'formData';
    }

    protected function getFormModel(): Model
    {
        /** @var \Illuminate\Database\Eloquent\Model&\Illuminate\Contracts\Auth\Authenticatable $user */
        $user = Filament::auth()->user();
        return $user;
    }

    public function mount(): void
    {
        $this->form->fill([
            // @phpstan-ignore-next-line
            'name'  =>  $this->getFormModel()->name,
            // @phpstan-ignore-next-line
            'username' =>  $this->getFormModel()->username,
        ]);
    }

    public function submit(): void
    {

        $data = $this->form->getState();

        $state = array_filter([
            'name'     => $data['name'],
            'username'    => $data['username'],
            'password' => $data['new_password'] ? Hash::make($data['new_password']) : null,
        ]);

        $this->getFormModel()->update($state);

        if ($data['new_password']) {
            // @phpstan-ignore-next-line
            Filament::auth()->login($this->getFormModel(), (bool)$this->getFormModel()->getRememberToken());
        }

        $this->notify('success', strval(__('filament::resources/pages/edit-record.messages.saved')));
    }

    public function getCancelButtonUrlProperty(): string
    {
        return static::getUrl();
    }

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Profile',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('General')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('username')
                        ->label('Username')
                        ->required(),
                ]),
            Section::make('Update Password')
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label('Current Password')
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->rules(['confirmed', Password::defaults()])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }
}

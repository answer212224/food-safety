<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Filament\Http\Livewire\Auth\Login;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\ValidationException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;


class Foo extends Login
{
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        if (!Filament::auth()->attempt([
            'uid' => $data['uid'],
            'password' => $data['password'],
        ], $data['remember'])) {
            throw ValidationException::withMessages([
                'uid' => __('filament::login.messages.failed'),
            ]);
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('uid')
                ->label('會員編號')
                ->required()
                ->autocomplete(),
            TextInput::make('password')
                ->label(__('filament::login.fields.password.label'))
                ->password()
                ->required(),
            Checkbox::make('remember')
                ->label(__('filament::login.fields.remember.label')),
        ];
    }

    public function render(): View
    {
        return view('filament::login')
            ->layout('filament::components.layouts.card', [
                'title' => __('filament::login.title'),
            ]);
    }
}

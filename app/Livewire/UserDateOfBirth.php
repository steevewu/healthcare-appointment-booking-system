<?php

namespace App\Livewire;

use Jeffgreco13\FilamentBreezy\Livewire\PersonalInfo;
use Filament\Forms;

class UserDateOfBirth extends PersonalInfo
{


    public function mount(): void
    {
        parent::mount();



        $role = $this->user->getRoleNames()->first();
        $dob = $this->user->{$role}?->dob ?? null;

        $this->form->fill(
            [
                'dob' => $dob
            ]
        );


    }


    protected function getProfileFormComponents(): array
    {
        return [
            $this->getDateOfBirthComponent()
        ];
    }


    protected function getDateOfBirthComponent(): Forms\Components\DatePicker
    {
        return Forms\Components\DatePicker::make('dob')
            ->label(__('filament::resources.dob'))
            ->required()
            ->displayFormat('d/m/Y');
    }
}

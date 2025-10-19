<?php

namespace App\Livewire;

use App\Notifications\SteeveNotification;
use DB;
use Exception;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Jeffgreco13\FilamentBreezy\Livewire\PersonalInfo;
use Filament\Forms;


class UserProfile extends PersonalInfo
{



    public array $only = ['fullname', 'email'];




    public function mount(): void
    {
        parent::mount();

        $role = $this->user->getRoleNames()->first();


        $fullname = $this->user->{$role}?->fullname ?? null;




        $this->form->fill(
            [
                'fullname' => $fullname,
                'email' => $this->user->email
            ]
        );
    }


    protected function getProfileFormComponents(): array
    {
        return [
            $this->getFullnameComponent(),
            $this->getEmailComponent()
        ];
    }



    protected function getFullnameComponent(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('fullname')
            ->required()
            ->minLength(10)
            ->maxLength(40)
            ->label(__('filament::resources.fullname'))
            ->hidden(fn() => Filament::getCurrentPanel()?->getId() == 'admin'); // hide `fullname` on admin panel cuz admin does not have personal infor

    }


    protected function getEmailComponent(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('email')
            ->required()
            ->unique('users', 'email', ignorable: $this->user)
            ->label(__('filament::resources.email'));
    }



    public function submit(): void
    {

        $this->validate();


        try {
            $data = collect($this->form->getState())->only($this->only)->all();


            DB::transaction(function () use ($data) {

                $this->user->update(
                    [
                        'email' => $data['email']
                    ]
                );


                $role = $this->user->getRoleNames()->first();



                $this->user->{$role}?->update(
                    [
                        'fullname' => $data['fullname']
                    ]
                );
            });



            SteeveNotification::sendSuccessNotification(action: 'update');


        } catch (Exception $e) {

            SteeveNotification::sendFailedNotification(message: $e->getMessage());
        }
    }




}

<?php

namespace App\Filament\Admin\Resources\OfficerResource\Pages;

use App\Filament\Admin\Resources\OfficerResource;
use App\Models\Officer;
use App\Models\User;
use Date;
use DB;
use Exception;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageOfficers extends ManageRecords
{
    protected static string $resource = OfficerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data, string $model, Actions\Action $action) {

                    try {
                        DB::transaction(function () use ($data, $model, $action) {

                            $user = new User(
                                [
                                    'email' => $data['email'],
                                    'password' => $data['password'],
                                ]
                            );

                            $user->assignRole('officer');

                            $user->forceFill(
                                [
                                    'email_verified_at' => Date::now(),
                                ]
                            );
                            $user->save();



                            $doctor = new Officer();

                            $doctor->forceFill(
                                [
                                    'user_id' => $user->id
                                ]
                            );
                            $doctor->save();
                        });


                        Notification::make(
                            'success'
                        )
                            ->title(__('filament::resources.success'))
                            ->body(__('filament::resources.succ_messages', ['action' => $action->getName()]), )
                            ->success()
                            ->seconds(5)
                            ->send();

                    } catch (Exception $e) {

                        Notification::make(
                            'error'
                        )
                            ->title(__('filament::resources.error'))
                            ->body(__('filament::resources.err_messages') . "\n" . $e->getMessage())
                            ->danger()
                            ->seconds(10)
                            ->send();


                    }
                })
                ->successNotification(null),
        ];
    }
}

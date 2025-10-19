<?php

namespace App\Filament\Admin\Resources\DoctorResource\Pages;

use App\Filament\Admin\Resources\DoctorResource;
use App\Models\Doctor;
use App\Models\User;
use App\Notifications\SteeveNotification;
use Date;
use DB;
use Exception;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageDoctors extends ManageRecords
{
    protected static string $resource = DoctorResource::class;

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

                            $user->assignRole('doctor');

                            $user->forceFill(
                                [
                                    'email_verified_at' => Date::now(),
                                ]
                            );
                            $user->save();



                            $doctor = new Doctor();

                            $doctor->forceFill(
                                [
                                    'user_id' => $user->id
                                ]
                            );
                            $doctor->save();
                        });


                        SteeveNotification::sendSuccessNotification(action: $action);

                    } catch (Exception $e) {

                        SteeveNotification::sendFailedNotification(message: $e->getMessage());


                    }
                })
                ->successNotification(null),
        ];
    }
}

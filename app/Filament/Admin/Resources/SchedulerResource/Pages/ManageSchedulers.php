<?php

namespace App\Filament\Admin\Resources\SchedulerResource\Pages;

use App\Filament\Admin\Resources\SchedulerResource;
use App\Models\Scheduler;
use App\Models\User;
use App\Notifications\SteeveNotification;
use Date;
use Exception;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\DB;

class ManageSchedulers extends ManageRecords
{
    protected static string $resource = SchedulerResource::class;

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

                            $user->assignRole('scheduler');

                            $user->forceFill(
                                [
                                    'email_verified_at' => Date::now(),
                                ]
                            );
                            $user->save();



                            $scheduler = new Scheduler();

                            $scheduler->forceFill(
                                [
                                    'user_id' => $user->id
                                ]
                                );
                            $scheduler->save();
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

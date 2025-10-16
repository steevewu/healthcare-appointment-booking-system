<?php

namespace App\Filament\Officer\Resources\DoctorResource\Pages;

use App\Filament\Officer\Resources\DoctorResource;
use App\Models\Doctor;
use App\Models\User;
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
            ->using(
                function (array $data, string $model, Actions\Action $action) {

                        // dd($action->getName());
                        // dd($data);
                        // dd(join('|', [$data['province_id'], $data['district_id'], $data['ward_id']]));
                        try {


                            DB::transaction(function() use ($data, $action){


                                $user = new User(
                                [
                                    'email' => $data['email'],
                                    'password' => $data['password']
                                ]
                            );
                            $user->assignRole('doctor');
                            $user->forceFill(
                                [
                                    'email_verified_at' => Date::now()
                                ]
                            );

                            $user->save();

                            $doctor = new Doctor(
                                [
                                    'user_id' => $user->id,
                                    'fullname' => $data['fullname'],
                                    'address' => join('|', [$data['province_id'], $data['district_id'], $data['ward_id']]),
                                    'dob' => $data['dob']
                                ]
                            );

                            $doctor->forceFill(
                                ['depart_id' => $data['depart_id']]
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

                    }
                )
                ->successNotification(null)
        ];
    }
}

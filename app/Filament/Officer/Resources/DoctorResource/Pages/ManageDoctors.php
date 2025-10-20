<?php

namespace App\Filament\Officer\Resources\DoctorResource\Pages;

use App\Filament\Officer\Resources\DoctorResource;
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
        ];

    }
}

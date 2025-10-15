<?php

namespace App\Filament\Officer\Resources\DoctorResource\Pages;

use App\Filament\Officer\Resources\DoctorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDoctors extends ManageRecords
{
    protected static string $resource = DoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

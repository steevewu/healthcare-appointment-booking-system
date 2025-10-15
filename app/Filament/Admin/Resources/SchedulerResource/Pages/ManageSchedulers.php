<?php

namespace App\Filament\Admin\Resources\SchedulerResource\Pages;

use App\Filament\Admin\Resources\SchedulerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSchedulers extends ManageRecords
{
    protected static string $resource = SchedulerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Officer\Pages;

use App\Filament\Officer\Widgets\AppointmentDistributionChart;
use App\Filament\Officer\Widgets\AppointmentHeatmap;
use DB;
use Filament\Pages\Page;

class AppointmentStatsPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.officer.pages.appointment-stats-page';



    
    public function getHeaderWidgets(): array
    {
        return [

            AppointmentDistributionChart::make(),
            AppointmentHeatmap::make()
        ];
    }

}

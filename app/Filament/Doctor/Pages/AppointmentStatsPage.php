<?php

namespace App\Filament\Doctor\Pages;

use App\Filament\Doctor\Widgets\AppointmentHeatmap;
use App\Filament\Doctor\Widgets\AppointmentLineChart;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class AppointmentStatsPage extends Page
{

    protected static string $view = 'filament.doctor.pages.appointment-stats-page';

    public function getHeading(): Htmlable|string
    {
        return __('filament::charts.appointments.title');
    }


    public function getTitle(): Htmlable|string
    {
        return __('filament::charts.appointments.title');
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return 'heroicon-o-presentation-chart-line';
    }


    public static function getNavigationLabel(): string
    {
        return __('filament::charts.appointments.label');
    }


    public static function getNavigationGroup(): ?string
    {
        return __('filament::charts.appointments.group');
    }



    protected function getHeaderWidgets(): array
    {
        return [
            AppointmentLineChart::make(),
            AppointmentHeatmap::make(),
        ];
    }

}

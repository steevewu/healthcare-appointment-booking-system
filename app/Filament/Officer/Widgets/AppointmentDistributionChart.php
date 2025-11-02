<?php

namespace App\Filament\Officer\Widgets;

use DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class AppointmentDistributionChart extends ApexChartWidget
{
    protected static ?string $chartId = 'appointmentDistributionChart';

    protected int|string|array $columnSpan = 'full';

    protected static bool $isDiscovered = false;



    protected function getHeading(): string|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\View|null
    {
        return __('filament::charts.heeh');
    }

    protected function getOptions(): array
    {
        if (!$this->readyToLoad) {
            return [];
        }

        $appointmentCounts = DB::table('departments')
            ->select([
                'departments.name',
                DB::raw('COUNT(appointments.id) as total_appointments'),
            ])
            ->leftJoin('doctors', 'doctors.depart_id', '=', 'departments.id')
            ->leftJoin('workshifts', 'workshifts.doctor_id', '=', 'doctors.id')
            ->leftJoin('appointments', 'appointments.workshift_id', '=', 'workshifts.id')
            ->groupBy('departments.id', 'departments.name')
            ->get();
        return [
            'chart' => [
                'type' => 'polarArea',
                'height' => 500,
            ],
            'series' => $appointmentCounts->pluck('total_appointments'),
            'labels' => $appointmentCounts->pluck('name')->toArray(),
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
        ];
    }
}

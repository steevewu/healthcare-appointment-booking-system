<?php

namespace App\Filament\Officer\Widgets;

use DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class AppointmentHeatmap extends ApexChartWidget
{
    protected static ?string $chartId = 'appointmentHeatmap';



    protected int|string|array $columnSpan = 'full';

    protected static bool $isDiscovered = false;



    protected function getHeading(): string|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\View|null
    {
        return __('filament::charts.heeh');
    }



    protected function getOptions(): array
    {

        if (!$this->readyToLoad)
            return [];


        $weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $rawData = DB::table('appointments')
            ->selectRaw('MONTH(created_at) as month, WEEKDAY(created_at) as weekday, COUNT(*) as total')
            ->whereIn('status', ['pending', 'confirmed'])
            ->groupBy('month', 'weekday')
            ->orderBy('month')
            ->orderBy('weekday')
            ->get();


        $heatmap = [];
        foreach ($weekDays as $i => $label) {
            $heatmap[$i] = [
                'name' => $label,
                'data' => array_map(function ($month) {
                    return ['x' => $month, 'y' => 0];
                }, $monthNames),
            ];
        }

        foreach ($rawData as $row) {
            $heatmap[$row->weekday]['data'][$row->month - 1]['y'] = $row->total;
        }






        return [
            'chart' => [
                'type' => 'heatmap',
                'height' => 500,
            ],
            'series' => $heatmap,
            'xaxis' => [
                'type' => 'category',
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'colors' => ['#008FFB'],
        ];
    }
}

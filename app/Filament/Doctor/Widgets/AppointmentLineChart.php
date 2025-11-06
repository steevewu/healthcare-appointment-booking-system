<?php

namespace App\Filament\Doctor\Widgets;

use Carbon\Carbon;
use DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms;


class AppointmentLineChart extends ApexChartWidget
{
    protected static ?string $chartId = 'appointmentLineChart';


    protected int|string|array $columnSpan = 'full';

    protected static bool $isDiscovered = false;


    protected function getHeading(): string|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\View|null
    {
        return __('filament::charts.appointments.heatmap.title');
    }

    protected function getFormSchema(): array
    {
        $minYear = DB::table('users')->min(DB::raw('YEAR(created_at)')) ?? 2020;
        return [
            Forms\Components\TextInput::make('start')
                ->numeric()
                ->minValue($minYear)
                ->maxValue(now()->year)
                ->default(now()->subYearsNoOverflow(2)->year),
            Forms\Components\TextInput::make('end')
                ->numeric()
                ->minValue($minYear)
                ->maxValue(now()->year)
                ->default(now()->year)
                ->gte('start')

        ];
    }


    protected function getOptions(): array
    {


        if (!$this->readyToLoad) {
            return [];
        }




        $startDate = Carbon::create($this->filterFormData['start'])->startOfYear();
        $endDate = Carbon::create($this->filterFormData['end'])->endOfYear();




        $appointmentData = DB::table('appointments AS a')
            ->join('workshifts AS w', 'a.workshift_id', '=', 'w.id')
            ->join('events AS e', 'w.event_id', '=', 'e.id')
            ->selectRaw(
                "
                YEAR(e.start_at) as year,
                MONTH(e.start_at) as month,
                count(w.id) as count
                "
            )
            ->whereBetween('e.start_at', [$startDate, $endDate])
            ->where('w.doctor_id', auth()->user()->doctor->id)
            ->whereIn('a.status', ['pending', 'confirmed'])
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month')
            ->get();


        $groupedByYear = $appointmentData->groupBy('year');

        $series = [];
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($groupedByYear as $year => $monthlyData) {
            $yearlyData = array_fill(0, 12, 0);

            foreach ($monthlyData as $data) {
                $yearlyData[$data->month - 1] = $data->count;
            }

            $series[] = [
                'name' => "{$year}",
                'data' => $yearlyData,
            ];
        }


        return [
            'chart' => [
                'type' => 'line',
                'height' => 500,
            ],
            'series' => $series,
            'dataLabels' => [
                'enabled' => true
            ],
            'xaxis' => [
                'categories' => $monthNames,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
                'title' => [
                    'text' => __('filament::charts.patients.enrollments.x-axis')
                ]
            ],
            'yaxis' => [
                'title' => [
                    'text' => __('filament::charts.patients.enrollments.y-axis')
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            // 'colors' => ['#f59e0b'],
            'stroke' => [
                'curve' => 'straight',
            ],
            'legend' => [
                'position' => 'top',
                'horizontalAlign' => 'left',
                'floating' => true,
                'offsetY' => -10,
                'offsetX' => -5

            ],
        ];
    }

}

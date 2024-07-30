<?php

namespace App\Filament\Widgets;
use App\Models\contact;
use App\Models\prospect;
use App\Models\client;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;
class contactchart extends ChartWidget
{
    protected int | string | array $columnSpan = 'full';
    public ?string $filter = 'month';
    protected static ?string $heading = 'Stastiques';

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Week',
            'month' => 'Month',
            'year' => 'Year',
        ];
    }

    protected function getData(): array
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        $data1 = [];
        $data2 = [];
        $data3 = [];
        if ($this->filter === 'month') {
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
            $data1 = Trend::model(Contact::class)
                ->between(start: $startDate, end: $endDate)
                ->perDay()
                ->count();
            $data2 = Trend::model(prospect::class)
                ->between(start: $startDate, end: $endDate)
                ->perDay()
                ->count();
            $data3 = Trend::model(client::class)
                ->between(start: $startDate, end: $endDate)
                ->perDay()
                ->count();
        }elseif ($this->filter === 'week') {
            $startDate =now()->subDays(7);
            $endDate = now();
           $data1 = Trend::model(Contact::class)
                ->between(start: $startDate, end: $endDate)
                ->perDay()
                ->count();
            $data2 = Trend::model(prospect::class)
                ->between(start: $startDate, end: $endDate)
                ->perDay()
                ->count();
            $data3 = Trend::model(client::class)
                ->between(start: $startDate, end: $endDate)
                ->perDay()
                ->count();
        } elseif ($this->filter === 'year') {
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
            $data1 = Trend::model(Contact::class)
                ->between(start: $startDate, end: $endDate)
                ->perMonth()
                ->count();
            $data2 = Trend::model(prospect::class)
                ->between(start: $startDate, end: $endDate)
                ->perMonth()
                ->count();
            $data3 = Trend::model(client::class)
                ->between(start: $startDate, end: $endDate)
                ->perMonth()
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'contacts',
                    'data' => $data1->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => "green",
                    'borderColor' => "green"
                ],
                [
                    'label' => 'Blue',
                    'data' =>  $data2->map(fn (TrendValue $value) => $value->aggregate),
                    "backgroundColor" => "blue",
                    'borderColor' => "blue"
                ],
                [
                    'label' => 'Red',
                    'data' =>  $data3->map(fn (TrendValue $value) => $value->aggregate),
                    "backgroundColor" => "red",
                    'borderColor' => "red"
                ],
            ],
            'labels' =>$data1->map(fn (TrendValue $value) => $value->date),

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

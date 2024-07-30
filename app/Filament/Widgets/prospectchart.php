<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\prospect;
class prospectchart extends ChartWidget
{
    protected static ?string $heading = 'Source des prospects';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $p1 = prospect::where('source', 'appel telephonique')->count();
        $p2 = prospect::where('source', 'Facebook')->count();
        $p3 = prospect::where('source', 'Instagram')->count();
        $p4 = prospect::where('source', 'siteweb')->count();
        $p5 = prospect::where('source', 'tiktok')->count();
        $p6 = prospect::where('source', 'visite au magasin')->count();
        $p7 = prospect::where('source', 'WhatsApp')->count();

        return [
            'datasets' => [
                [
                    'data' => [$p1,$p2,$p3,$p4,$p5,$p6,$p7],
                    'backgroundColor' => [
                        'rgb(169, 190, 212)',
                        'rgb(24, 119, 242)',
                        'rgb(235, 54, 126)',
                        'rgb(237, 195, 7)',
                        'rgb(28, 28, 33)',
                        'rgb(219, 24, 63)',
                        'rgb(37 211 102)',
                    ],
                ],
            ],
            'labels' => ['Appel telephonique','Facebook', 'Instagram','Siteweb', 'TikTok', 'Visite au magasin', 'WhatsApp'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
     protected function getOptions(): array|\Filament\Support\RawJs|null
    {
        return [
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false]
            ],
        ];
    }
}

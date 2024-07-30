<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\client;
use App\Models\contact;
use App\Models\prospect;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class contactCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
           // Stat::make('Unique views', ),
            Stat::make('contacts',contact::count())
            ->icon('heroicon-o-users'),
            Stat::make('prospects',prospect::count())
            ->icon('heroicon-s-magnifying-glass'),
            Stat::make('clients',client::count())
            ->icon('heroicon-o-credit-card')
        ];
    }
}

<?php

namespace App\Filament\Resources\ProspectResource\Pages;

use App\Filament\Resources\ProspectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListProspects extends ListRecords
{
    protected static string $resource = ProspectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
            ->color("info")
            ->icon('heroicon-s-arrow-up-tray')
            ->exports([
                ExcelExport::make()
                ->fromForm()
                ->withFilename(fn ($resource) => $resource::getModelLabel(). '-' . date('Y-m-d'))
                ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
            ]),

        ];
    }
}

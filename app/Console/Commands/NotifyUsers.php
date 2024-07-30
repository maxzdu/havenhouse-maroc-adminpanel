<?php

namespace App\Console\Commands;
use App\Filament\Resources\ContactResource;
use App\Filament\Resources\ProspectResource;
use Illuminate\Console\Command;
use App\Models\Prospect;
use Filament\Notifications\Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\contact;
use Filament\Notifications\Actions\Action;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $recipient = User::where('name', 'admin')->get();

        $prospects = Prospect::all();
        foreach ($prospects as $prospect) {
            $relanceDate = Carbon::parse($prospect->relance);
            $RDVDate = Carbon::parse($prospect->RDV);
            if ($relanceDate->copy()->subDay()->isToday()) {
                Notification::make()
                    ->icon('heroicon-o-exclamation-circle')
                    ->iconColor('primary')
                    ->send()
                    ->title('Relance')
                    ->body("Demain est la relance de prospect {$prospect->nom}")
                    ->actions([
                        Action::make('voir')
                        ->url(ProspectResource::getUrl('view',['record'=>$prospect]))
                        ->button()
                        ->color('primary')
                    ])
                    ->sendToDatabase($recipient) // Assuming user is the recipient
                    ;
                }

            if ($RDVDate->copy()->subDay()->isToday()) {
                Notification::make()
                    ->icon('heroicon-o-exclamation-triangle')
                    ->iconColor('danger')
                    ->title('RDV')
                    ->body("Demain est le rendez-vous avec prospect {$prospect->nom}")
                    ->actions([
                        Action::make('voir')
                        ->url(ProspectResource::getUrl('view',['record'=>$prospect]))
                        ->button()
                        ->color('danger')
                    ])
                    ->sendToDatabase($recipient) // Assuming user is the recipient
                    ->send();
                }
        }
        $contacts=contact::all();
        foreach ($contacts as $contact) {
            $relanceDate1 = Carbon::parse($contact->relance1);
            $RDVDate1 = Carbon::parse($contact->RDV1);
            if ($relanceDate1->copy()->subDay()->isToday()) {
                Notification::make()
                ->icon('heroicon-o-exclamation-circle')
                ->iconColor('primary')
                ->title('Relance de phase de decouvert 1')
                ->body("Demain est la relance de phase de decouvert 1 avec {$contact->nom}")
                ->actions([
                    Action::make('voir')
                    ->url(ContactResource::getUrl('view',['record'=>$contact]))
                    ->button()
                    ->color('primary')
                ])
                ->sendToDatabase($recipient) // Assuming user is the recipient
                ->send();
                }

            if ($RDVDate1->copy()->subDay()->isToday()) {
                Notification::make()
                    ->icon('heroicon-o-exclamation-triangle')
                    ->iconColor('danger')
                    ->title('RDV de phase de decouvert 1')
                    ->body("Demain est le rendez-vous de phase de decouvert 1 avec {$contact->nom}")
                    ->actions([
                        Action::make('voir')
                        ->url(ContactResource::getUrl('view',['record'=>$contact]))
                        ->button()
                        ->color('danger')
                    ])
                    ->sendToDatabase($recipient) // Assuming user is the recipient
                    ->send();
                }
            $relanceDate2 = Carbon::parse($contact->relance2);
            $RDVDate2 = Carbon::parse($contact->RDV2);
            if ($relanceDate2->copy()->subDay()->isToday()) {
                Notification::make()
                ->icon('heroicon-o-exclamation-circle')
                ->iconColor('primary')
                ->title('Relance de phase de decouvert 2')
                ->body("Demain est la relance de phase de decouvert 2 avec {$contact->nom}")
                ->actions([
                    Action::make('voir')
                    ->url(ContactResource::getUrl('view',['record'=>$contact]))
                    ->button()
                    ->color('primary')
                ])
                ->sendToDatabase($recipient) // Assuming user is the recipient
                ->send();
                }

            if ($RDVDate2->copy()->subDay()->isToday()) {
                Notification::make()
                ->icon('heroicon-o-exclamation-triangle')
                ->iconColor('danger')
                ->title('RDV de phase de decouvert 2')
                ->body("Demain est le rendez-vous de phase de decouvert 2 avec {$contact->nom}")
                ->actions([
                    Action::make('voir')
                    ->url(ContactResource::getUrl('view',['record'=>$contact]))
                    ->button()
                    ->color('danger')
                ])
                ->sendToDatabase($recipient) // Assuming user is the recipient
                ->send();
                }
            $relanceDate3 = Carbon::parse($contact->relance3);
            $RDVDate3 = Carbon::parse($contact->RDV3);
            if ($relanceDate3->copy()->subDay()->isToday()) {
                Notification::make()
                ->icon('heroicon-o-exclamation-circle')
                ->iconColor('primary')
                ->title('Relance de phase de proposition')
                ->body("Demain est la relance de phase de proposition avec {$contact->nom}")
                ->actions([
                    Action::make('voir')
                    ->url(ContactResource::getUrl('view',['record'=>$contact]))
                    ->button()
                    ->color('primary')
                ])
                ->sendToDatabase($recipient) // Assuming user is the recipient
                ->send();
                }

            if ($RDVDate3->copy()->subDay()->isToday()) {
                Notification::make()
                ->icon('heroicon-o-exclamation-triangle')
                ->iconColor('danger')
                ->title('RDV de phase de proposition')
                ->body("Demain est le rendez-vous de phase de proposition avec {$contact->nom}")
                ->actions([
                    Action::make('voir')
                    ->url(ContactResource::getUrl('view',['record'=>$contact]))
                    ->button()
                    ->color('danger')
                ])
                ->sendToDatabase($recipient) // Assuming user is the recipient
                ->send();
                }
            $relanceDate4 = Carbon::parse($contact->relance4);
            $RDVDate4 = Carbon::parse($contact->RDV4);
            if ($relanceDate4->copy()->subDay()->isToday()) {
                Notification::make()
                ->icon('heroicon-o-exclamation-circle')
                ->iconColor('primary')
                ->title('Relance de phase de prix')
                ->body("Demain est la relance de phase de prix avec {$contact->nom}")
                ->actions([
                    Action::make('voir')
                    ->url(ContactResource::getUrl('view',['record'=>$contact]))
                    ->button()
                    ->color('primary')
                ])
                ->sendToDatabase($recipient) // Assuming user is the recipient
                ->send();
                }

            if ($RDVDate4->copy()->subDay()->isToday()) {
                Notification::make()
                ->icon('heroicon-o-exclamation-triangle')
                ->iconColor('danger')
                ->title('RDV de phase de prix')
                ->body("Demain est le rendez-vous de phase de prix avec {$contact->nom}")
                ->actions([
                    Action::make('voir')
                    ->url(ContactResource::getUrl('view',['record'=>$contact]))
                    ->button()
                    ->color('danger')
                ])
                ->sendToDatabase($recipient) // Assuming user is the recipient
                ->send();
                }
        }
    }
}

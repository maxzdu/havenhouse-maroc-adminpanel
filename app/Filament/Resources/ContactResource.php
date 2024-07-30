<?php

namespace App\Filament\Resources;
use App\Filament\Resources\ContactResource\Pages;
use Filament\Forms\Components\Actions\Action;
use App\Models\Contact;
use Filament\Actions\Action as ActionsAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\HtmlString;
use Filament\Pages\Actions;
use App\Filament\Resources\ClientResource;
use App\Models\client;
use App\Models\prospect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
    //$nom=(String)$form->model->nom;
   //var_dump(contact $record);
        return $form
        ->schema([
            Forms\Components\Wizard::make([
                Wizard\Step::make('découverte1')
                    ->schema([
                        Forms\Components\TextInput::make('nom')
                        ->default(null)
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('telephone')
                        ->default(null)
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                        Forms\Components\Select::make('ville')
                        ->default(null)
                        ->searchable()
                        ->required()
                        ->options([
                            'Ad Dakhla'=>'Ad Dakhla', 'Ad Darwa'=>'Ad Darwa', 'Agadir'=>'Agadir', 'Aguelmous'=>'Aguelmous', 'Ain El Aouda'=>'Ain El Aouda',
                            'Ait Melloul'=>'Ait Melloul', 'Ait Ourir'=>'Ait Ourir', 'Al Aaroui'=>'Al Aaroui', 'Al Fqih Ben Çalah'=>'Al Fqih Ben Çalah',
                            'Al Hoceïma'=>'Al Hoceïma', 'Al Khmissat'=>'Al Khmissat', 'Al Attawia'=>'Al Attawia', 'Arfoud'=>'Arfoud', 'Azemmour'=>'Azemmour',
                            'Aziylal'=>'Aziylal', 'Azrou'=>'Azrou', 'Aïn Harrouda'=>'Aïn Harrouda', 'Aïn Taoujdat'=>'Aïn Taoujdat', 'Barrechid'=>'Barrechid',
                            'Ben Guerir'=>'Ben Guerir', 'Beni Yakhlef'=>'Beni Yakhlef', 'Berkane'=>'Berkane', 'Biougra'=>'Biougra', 'Bir Jdid'=>'Bir Jdid',
                            'Bou Arfa'=>'Bou Arfa', 'Boujad'=>'Boujad', 'Bouknadel'=>'Bouknadel', 'Bouskoura'=>'Bouskoura', 'Béni Mellal'=>'Béni Mellal',
                            'Casablanca'=>'Casablanca', 'Chichaoua'=>'Chichaoua', 'Demnat'=>'Demnat', 'El Aïoun'=>'El Aïoun', 'El Hajeb'=>'El Hajeb',
                            'El Jadid'=>'El Jadid', 'El Kelaa des Srarhna'=>'El Kelaa des Srarhna', 'Errachidia'=>'Errachidia', 'Fnidq'=>'Fnidq', 'Fès'=>'Fès',
                            'Guelmim'=>'Guelmim', 'Guercif'=>'Guercif', 'Iheddadene'=>'Iheddadene', 'Imzouren'=>'Imzouren', 'Inezgane'=>'Inezgane', 'Jerada'=>'Jerada',
                             'Kenitra'=>'Kenitra', 'Khénifra'=>'Khénifra', 'Kouribga'=>'Kouribga', 'Ksar El Kebir'=>'Ksar El Kebir', 'Larache'=>'Larache', 'Laâyoune'=>'Laâyoune',
                             'Marrakech'=>'Marrakech', 'Martil'=>'Martil', 'Mechraa Bel Ksiri'=>'Mechraa Bel Ksiri', 'Mehdya'=>'Mehdya', 'Meknès'=>'Meknès', 'Midalt'=>'Midalt',
                            'Missour'=>'Missour', 'Mohammedia'=>'Mohammedia', 'Moulay Abdallah'=>'Moulay Abdallah', 'Moulay Bousselham'=>'Moulay Bousselham', 'Mrirt'=>'Mrirt',
                            'My Drarga'=>'My Drarga', 'M’diq'=>'M’diq', 'Nador'=>'Nador', 'Oued Zem'=>'Oued Zem', 'Ouezzane'=>'Ouezzane', 'Oujda-Angad'=>'Oujda-Angad',
                            'Oulad Barhil'=>'Oulad Barhil', 'Oulad Tayeb'=>'Oulad Tayeb', 'Oulad Teïma'=>'Oulad Teïma', 'Oulad Yaïch'=>'Oulad Yaïch', 'Qasbat Tadla'=>'Qasbat Tadla',
                            'Rabat'=>'Rabat', 'Safi'=>'Safi', 'Sale'=>'Sale', 'Sefrou'=>'Sefrou', 'Settat'=>'Settat', 'Sidi Qacem'=>'Sidi Qacem', 'Sidi Slimane'=>'Sidi Slimane',
                            'Sidi Smai’il'=>'Sidi Smai’il', 'Sidi Yahia El Gharb'=>'Sidi Yahia El Gharb', 'Sidi Yahya Zaer'=>'Sidi Yahya Zaer', 'Skhirate'=>'Skhirate',
                            'Souk et Tnine Jorf el Mellah'=>'Souk et Tnine Jorf el Mellah', 'Souq Sebt Oulad Nemma'=>'Souq Sebt Oulad Nemma', 'Tahla'=>'Tahla', 'Tameslouht'=>'Tameslouht',
                             'Tangier'=>'Tangier', 'Taourirt'=>'Taourirt', 'Taza'=>'Taza', 'Temara'=>'Temara', 'Temsia'=>'Temsia', 'Tifariti'=>'Tifariti', 'Tit Mellil'=>'Tit Mellil',
                             'Tiznit'=>'Tiznit', 'Tétouan'=>'Tétouan', 'Youssoufia'=>'Youssoufia', 'Zagora'=>'Zagora', 'Zawyat ech Cheïkh'=>'Zawyat ech Cheïkh', 'Zaïo'=>'Zaïo', 'Zeghanghane'=>'Zeghanghane'
                        ])
                        ->default(null),
                    Forms\Components\TextInput::make('adress')
                        ->maxLength(255)
                        ->default(null),
                        Forms\Components\DateTimePicker::make('RDV1')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\DateTimePicker::make('relance1')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\MarkdownEditor::make('dialog')
                        ->default(null)
                        ]),
                Wizard\Step::make('découverte 2')
                    ->schema([
                        Forms\Components\DateTimePicker::make('RDV2')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\DateTimePicker::make('relance2')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\MarkdownEditor::make('Compte-Rendu2')
                        ->default(null)
                    ]),
                    Wizard\Step::make('proposition')
                    ->schema([
                        Forms\Components\DateTimePicker::make('RDV3')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\DateTimePicker::make('relanc3')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\MarkdownEditor::make('Compte-Rendu3')
                        ->default(null)
                    ]),
                    Wizard\Step::make('prix')
                    ->schema([
                        Forms\Components\DateTimePicker::make('RDV4')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\DateTimePicker::make('relanc4')
                        ->seconds(false)
                        ->default(null),
                        Forms\Components\MarkdownEditor::make('Compte-Rendu4')
                        ->default(null)
                    ]),
                    Wizard\Step::make('Vente')
                    ->schema([
                        Forms\Components\TextInput::make('prix')
                        ->default(null)
                    ]),
            ])
            ->columnSpan('full')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
            Tables\Columns\TextColumn::make('telephone')
                ->searchable(),
            Tables\Columns\TextColumn::make('ville')
                ->searchable(),
            Tables\Columns\TextColumn::make('prix')
                ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\Action::make('confirm')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-credit-card')
                    ->url(fn ($record) => $record->prix !== 0 ? ClientResource::getUrl('create', ['nom' => $record->nom, 'telephone' => $record->telephone]) : null),
                   /* Tables\Actions\Action::make('confirm')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-credit-card')
                    ->url(fn ($record)=>ClientResource::getUrl('create', ['nom' =>$record->nom,'telephone'=>$record->telephone])),*/
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}

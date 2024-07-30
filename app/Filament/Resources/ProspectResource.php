<?php
namespace App\Filament\Resources;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\ProspectResource\Pages;
use App\Models\Prospect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Carbon\Carbon;
class ProspectResource extends Resource
{
    protected static ?string $model = Prospect::class;

    protected static ?string $navigationIcon = 'heroicon-s-magnifying-glass';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->default(null)
                    ->required(),
                    Forms\Components\Select::make('nature de projet')
                    ->options([
                        'Nouvel aménagement' => 'Nouvel aménagement',
                        'Rénovation' => 'Rénovation',
                        'Réaménagement' => 'Réaménagement',
                        'Autres' => 'Autres'
                    ])
                    ->default(null),
                    Forms\Components\Select::make('source')
                    ->options([
                        'Appel telephonique' => 'Appel telephonique',
                        'Facebook' => 'Facebook',
                        'Instagram' => 'Instagram',
                        'Siteweb' => 'Siteweb',
                        'Tiktok' => 'Tiktok',
                        'Visite au magasin' => 'Visite au magasin',
                        'WhatsApp' => 'WhatsApp'
                    ])
                    ->default(null),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                    Forms\Components\Select::make('ville')
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
                    ]),
                Forms\Components\TextInput::make('adress')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DateTimePicker::make('RDV')
                ->seconds(false),
                Forms\Components\DateTimePicker::make('relance')
                ->seconds(false),
                Forms\Components\FileUpload::make('plan')
                ->columnSpan('full')
                ->multiple()
                ->preserveFilenames()
                ->openable()
                ->downloadable()
                ->fetchFileInformation(false)
                ->default(null),
                Forms\Components\MarkdownEditor::make('Compte-Rendu')
                            ->default(null)
                            ->required()
                            ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('source')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ville')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('adress')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('RDV')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('relance')
                    ->dateTime()
                    ->sortable(),
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
                    Tables\Actions\ViewAction::make()
                    ->SlideOver(),
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
            'index' => Pages\ListProspects::route('/'),
            'create' => Pages\CreateProspect::route('/create'),
            'view' => Pages\ViewProcpect::route('/{record}'),
            'edit' => Pages\EditProspect::route('/{record}/edit'),
        ];
    }
}

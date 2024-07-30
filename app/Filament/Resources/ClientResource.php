<?php

namespace App\Filament\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        $nom = request()->input('nom');
        $telephone = request()->input('telephone');

        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                ->default($nom)
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('telephone')
                ->default($telephone)
                ->maxLength(255),
                Forms\Components\DatePicker::make('paydate')
                        ->default(null)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('nom')
                ->searchable(),
            Tables\Columns\TextColumn::make('telephone')
                ->searchable(),
            Tables\Columns\TextColumn::make('paydate')
                    ->date()
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
                Tables\Actions\Action::make('Download Pdf')
                    ->icon('heroicon-s-pdf-file')
                    ->url(fn(client $record )=>route('client.pdf.download',$record))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Department;
use App\Models\Doctor;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentClusters\Forms\Cluster;
use Http;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Jacobtims\InlineDateTimePicker\Forms\Components\InlineDateTimePicker;
use Propaganistas\LaravelPhone\Concerns\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function getModelLabel(): string
    {
        return __('filament::resources.doctors.label');
    }


    public static function getPluralModelLabel(): string
    {
        return __('filament::resources.doctors.plural_label');
    }
    public static function getNavigationLabel(): string
    {
        return __('filament::resources.navigation_label', ['model' => DoctorResource::getModelLabel()]);
    }
    public static function getNavigationIcon(): string|Htmlable|null
    {
        return 'heroicon-o-user-group';
    }


    public static function getNavigationGroup(): ?string
    {
        return __('filament::resources.doctors.group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Forms\Components\TextInput::make('email')
                    ->required()
                    ->autofocus()
                    ->email()
                    ->unique('users', 'email')
                    ->label(__('filament::resources.email')),
                PhoneInput::make('phone')
                    ->required()
                    ->inputNumberFormat(PhoneInputNumberType::NATIONAL)
                    ->displayNumberFormat(PhoneInputNumberType::E164)
                    ->strictMode()
                    // ->validateFor(
                    //     'vi',
                    //     'mobile',
                    //     true
                    // )
                    ->placeholderNumberType('FIXED_LINE')
                    ->onlyCountries(
                        ['us', 'kr', 'vn', 'cn']
                    )
                    ->countryOrder(
                        ['vn', 'cn', 'us', 'kr']
                    )
                    ->countrySearch(false)
                    ->initialCountry('vn')
                    ->label(__('filament::resources.phone_number')),
                Forms\Components\TextInput::make('password')
                    ->required()
                    ->confirmed()
                    ->password()
                    ->revealable()
                    ->minLength(8)
                    ->maxLength(128)
                    ->label(__('password')),
                Forms\Components\TextInput::make('password_confirmation')
                    ->required()
                    ->password()
                    ->revealable()
                    ->dehydrated(false)
                    ->label(__('password_confirm')),
                Forms\Components\TextInput::make('fullname')
                    ->required()
                    ->minLength(10)
                    ->maxLength(40)
                    ->label(__('filament::resources.fullname')),
                Cluster::make(
                    [
                        Forms\Components\Select::make('province_id')
                            ->options(
                                function () {
                                    $provinces = Http::withHeaders(
                                        [
                                            'Accept' => 'application/json',
                                        ]
                                    )
                                        ->withQueryParameters(
                                            [
                                                'depth' => 1
                                            ]
                                        )
                                        ->withoutVerifying()
                                        ->get(config('app.address_api'));

                                    return collect($provinces->json())->pluck('name', 'code')->toArray();
                                }
                            )
                            ->placeholder(__('filament::resources.province'))
                            ->reactive()
                            ->searchable()
                            ->afterStateUpdated(
                                function ($state, callable $set) {
                                    $set('district_id', null);
                                }
                            ),
                        Forms\Components\Select::make('district_id')
                            ->label("Huyen")
                            ->options(
                                function (callable $get) {

                                    // fetch user's selected province
                                    $province = $get('province_id');


                                    if (!$province)
                                        return [];
                                    $districts = Http::withHeaders(
                                        [
                                            'Accept' => 'application/json',
                                        ]
                                    )
                                        ->withQueryParameters(
                                            [
                                                'depth' => 2
                                            ]
                                        )
                                        ->withoutVerifying()
                                        ->get(config('app.address_api') . "/p/{$province}");

                                    return collect($districts->json()['districts'])->pluck('name', 'code')->toArray();
                                }
                            )
                            ->placeholder(__('filament::resources.district'))
                            ->reactive()
                            ->searchable()
                            ->afterStateUpdated(
                                function ($state, callable $set) {
                                    $set('ward_id', null);
                                }
                            ),
                        Forms\Components\Select::make('ward_id')
                            ->label("Xa")
                            ->options(
                                function (callable $get) {
                                    $district = $get('district_id');


                                    if (!$district)
                                        return [];
                                    $wards = Http::withHeaders(
                                        [
                                            'Accept' => 'application/json',
                                        ]
                                    )
                                        ->withQueryParameters(
                                            [
                                                'depth' => 2
                                            ]
                                        )
                                        ->withoutVerifying()
                                        ->get(config('app.address_api') . "/d/{$district}");


                                    return collect($wards->json()['wards'])->pluck('name', 'code')->toArray();

                                }
                            )
                            ->placeholder(__('filament::resources.ward'))
                            ->reactive()
                            ->searchable(),
                    ]
                )
                    ->label(__('filament::resources.address'))
                    ->columns(1)
                    ->required(),
                InlineDateTimePicker::make('dob')
                    ->required()
                    ->default(today())
                    ->minDate(Carbon::createFromDate(1945, 1, 1))
                    ->maxDate(today())
                    ->time(false)
                    ->seconds(false)
                    ->label(__('filament::resources.dob')),

                Forms\Components\Select::make('depart_id')
                    ->required()
                    ->options(
                        function () {
                            return Department::all()->pluck('name', 'id')->toArray();
                        }
                    )
                    ->label(__('filament::resources.departments.label'))
                    ->reactive()
                    ->placeholder(__('filament::resources.departments.place_holder'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDoctors::route('/'),
        ];
    }



}

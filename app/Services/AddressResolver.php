<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddressResolver
{



    public static function resolveName(?string $address): array
    {

        // return the name of each address's component: province_name, district_name, ward_name
        // e.g: Phuong Phuc Xa, Quan Ba Dinh, Thanh pho Ha Noi


        if (is_null($address))
            return [
                'ward' => null,
                'district' => null,
                'province' => null,
            ];


        [$p_id, $d_id, $w_id] = self::resolveCode($address);



        $data = Http::withQueryParameters(
            [
                'depth' => 3,
            ]
        )
        ->get(config('app.address_api') . "/p/{$p_id}")
        ->json();


        return [
            'ward' => self::getWardName($data['districts'], $w_id),
            'district' => self::getDistrictName($data['districts'], $d_id),
            'province' => $data['name'],
        ];


    }


    public static function resolveCode(?string $address): array
    {

        // return the alias code of each address's component: province_name, district_name, ward_name
        // e.g: [1, 1, 1]


        if (is_null($address))
            return [null, null, null];


        return array_map('intval', explode('|', $address));
    }





    private static function getDistrictName(array $data, int $code): string
    {


        $districts = array_filter(
            $data,
            fn($district) => $district['code'] == $code
        );

        $district = reset($districts); // Reset gets the first (and only) match

        return $district ? $district['name'] : 'Unknown district';
    }



    private static function getWardName(array $data, int $code): string
    {
        foreach ($data as $district) {
            $ward = array_filter($district['wards'], fn($ward) => $ward['code'] == $code);
            $ward = reset($ward);
            if ($ward) {
                return $ward['name'];
            }
        }
        return 'Unknown ward';

    }

}
<?php
namespace App\Containers\Bank\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Containers\Bank\Models\Gateway;
use App\Containers\Bank\Models\Psp;

class GatewaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asanpay = Psp::where('slug', 'asanpay')->first();

        Gateway::create(
            [
            'psp_id'    => $asanpay->id,
            'name'       => 'درگاه داخلی آسان پی',
            'sheba'      => 'IR650560088480002835963001',
            'status'     => true,
            'properties' => '{}',
            'wallet_id'  => 101,
            ]
        );

        $saman = Psp::where('slug', 'saman')->first();

        Gateway::create(
            [
            'psp_id'    => $saman->id,
            'name'       => 'درگاه سامان',
            'sheba'      => 'IR650560088480002835963001',
            'status'     => true,
            'properties' => json_encode(
                [
                'terminal_id'   => 'X123457Y-X1234Z',
                'terminal_pass' => '12345'
                ]
            ),

            'wallet_id'  => 102,
            ]
        );

        $parsian = Psp::where('slug', 'parsian')->first();

        Gateway::create(
            [
            'psp_id'    => $parsian->id,
            'name'       => 'درگاه پارسیان',
            'sheba'      => 'IR650560088480002835963001',
            'status'     => true,
            'properties' => json_encode(
                [
                'pin'   => '1u1KRHFvYkHV3TLcgAyv',
                'terminal_pass' => '12345',
                ]
            ),
            'wallet_id'  => 103,
            ]
        );
    }
}

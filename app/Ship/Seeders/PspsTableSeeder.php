<?php

namespace App\Ship\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Psp;

class PspsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // for users whom select to pay an invoice by his/her balance in AsanPay
    Psp::create([
      'name'      => 'آسان پی',
      'slug'      => 'asanpay',
      'is_active' => true,
      'app_gate'  => true,
    ]);

    Psp::create([
      'name'           => 'سامان',
      'slug'           => 'saman',
      'is_active'      => true,
      'is_bank'        => true,
      'refund_support' => true,
    ]);

    Psp::create([
      'name'           => 'پارسیان',
      'slug'           => 'parsian',
      'is_active'      => true,
      'is_bank'        => true,
      'refund_support' => true,
    ]);

    Psp::create([
      'name'      => 'سداد',
      'slug'      => 'melli',
      'is_bank'   => true,
      'is_active' => false,
    ]);

    Psp::create([
      'name'           => 'پاسارگاد',
      'slug'           => 'pasargad',
      'is_active'      => false,
      'is_bank'        => true,
      'refund_support' => true,
    ]);

    Psp::create([
      'name'      => 'نوین آرین',
      'slug'      => 'eghtesadnovin',
      'is_bank'   => true,
      'is_active' => false,
    ]);

    Psp::create([
      'name'           => 'به پراخت ملت',
      'slug'           => 'mellat',
      'is_active'      => false,
      'is_bank'        => true,
      'refund_support' => true,
    ]);

    Psp::create([
      'name'           => 'مبنا کارت آریا',
      'slug'           => 'saderat',
      'is_active'      => false,
      'is_bank'        => true,
      'refund_support' => true,
    ]);

    Psp::create([
      'name'      => 'بانک گردشگری',
      'slug'      => 'gardeshgari',
      'is_active' => false,
      'is_bank'   => true,
    ]);

    Psp::create([
      'name'      => 'آسان پرداخت',
      'slug'      => 'asanpardakht',
      'is_active' => false,
    ]);

    Psp::create([
      'name'      => 'سایان کارت',
      'slug'      => 'sayancard',
      'is_active' => false,
    ]);

    Psp::create([
      'name'      => 'فناوا کارت',
      'slug'      => 'fanavacard',
      'is_active' => false,
    ]);

    Psp::create([
      'name'      => 'ایران کیش',
      'slug'      => 'irankish',
      'is_active' => false,
    ]);

    Psp::create([
      'name'      => 'پرداخت الکترونیک سپهر',
      'slug'      => 'sepehrpay',
      'is_active' => false,
    ]);
  }
}

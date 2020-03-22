<?php

namespace App\Containers\Bank\Data\Seeders;

use App\Containers\Bank\Models\Bank;
use App\Ship\Parents\Seeders\Seeder;

class BanksTableSeeder extends Seeder
{
  public function run()
  {
    Bank::create([
      'name' => 'بانک سامان',
      'slug' => 'saman',
    ]);

    Bank::create([
      'name' => 'بانک پارسیان',
      'slug' => 'parsian',
    ]);

    Bank::create([
      'name' => 'بانک ملی',
      'slug' => 'melli',
    ]);

    Bank::create([
      'name' => 'بانک پاسارگاد',
      'slug' => 'pasargad',
    ]);

    Bank::create([
      'name' => 'بانک اقتصاد نوین',
      'slug' => 'eghtesadnovin',
    ]);

    Bank::create([
      'name' => 'بانک کارآفرین',
      'slug' => 'karafarin',
    ]);

    Bank::create([
      'name' => 'بانک سرمایه',
      'slug' => 'sarmayeh',
    ]);

    Bank::create([
      'name' => 'بانک آینده',
      'slug' => 'ayandeh',
    ]);

    Bank::create([
      'name' => 'بانک ملت',
      'slug' => 'mellat',
    ]);

    Bank::create([
      'name' => 'بانک صادرات',
      'slug' => 'saderat',
    ]);

    Bank::create([
      'name' => 'بانک تجارت',
      'slug' => 'tejarat',
    ]);

    Bank::create([
      'name' => 'بانک کشاورزی',
      'slug' => 'keshavarzi',
    ]);

    Bank::create([
      'name' => 'بانک  رفاه',
      'slug' => 'refah',
    ]);

    Bank::create([
      'name' => 'بانک توسعه صادرات',
      'slug' => 'tose_saderat',
    ]);

    Bank::create([
      'name' => 'بانک شهر',
      'slug' => 'shahr',
    ]);

    Bank::create([
      'name' => 'بانک سپه',
      'slug' => 'sepah',
    ]);

    Bank::create([
      'name' => 'بانک صنعت و معدن',
      'slug' => 'sanatomadan',
    ]);

    Bank::create([
      'name' => 'بانک قرض الحسنه رسالت',
      'slug' => 'gharzolhasane_resalat',
    ]);

    Bank::create([
      'name' => 'بانک مهر اقتصاد',
      'slug' => 'mehr_eghtesad',
    ]);

    Bank::create([
      'name' => 'بانک ایران زمین',
      'slug' => 'iranzamin',
    ]);

    Bank::create([
      'name' => 'بانک گردشگری',
      'slug' => 'gardeshgari',
    ]);

    Bank::create([
      'name' => 'بانک حکمت ایرانیان',
      'slug' => 'hekmat_iranian',
    ]);

    Bank::create([
      'name' => 'بانک خاورمیانه',
      'slug' => 'khavarmianeh',
    ]);

    Bank::create([
      'name' => 'بانک دی',
      'slug' => 'day',
    ]);

    Bank::create([
      'name' => 'بانک مسکن',
      'slug' => 'maskan',
    ]);
  }
}

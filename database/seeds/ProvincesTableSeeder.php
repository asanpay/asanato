<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Ship\Enum\LocationType;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.آذربایجان_شرقی']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.آذربایجان_غربی']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.اردبیل']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.اصفهان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.البرز']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.ایلام']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.بوشهر']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.تهران']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.چهارمحال_بختیاری']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.خراسان_جنوبی']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.خراسان_رضوی']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.خراسان_شمالی']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.خوزستان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.زنجان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.سمنان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.سیستان_و_بلوچستان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.فارس']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.قزوین']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.قم']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.كردستان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.كرمان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.كرمانشاه']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.كهكیلویه_و_بویراحمد']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.گلستان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.گیلان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.لرستان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.مازندران']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.مركزی']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.هرمزگان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.همدان']);
		DB::table('locations')->insert(['type' => LocationType::STATE, 'path' => 'Iran.یزد']);
    }
}

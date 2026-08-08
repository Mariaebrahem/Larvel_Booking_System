<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ar_SA'); // استخدام اللغة العربية للبيانات العشوائية

        // 1. حسابات الأساسية (Admin & User)
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Test User',
                'email' => 'user@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => now(), 'updated_at' => now(),
            ]
        ]);

        // إضافة 50 مستخدم عشوائي
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 2. إنشاء قائمة مدن
        $cities = ['القاهرة', 'الإسكندرية', 'الجيزة', 'شرم الشيخ', 'الغردقة', 'الأقصر', 'أسوان', 'دهب', 'مرسى علم', 'مطروح'];
        $cityIds = [];
        foreach ($cities as $cityName) {
            $cityIds[] = DB::table('cities')->insertGetId([
                'name' => $cityName,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 3. أنواع الغرف
        $roomTypes = ['غرفة مفردة (Single)', 'غرفة مزدوجة (Double)', 'جناح جونيور (Junior Suite)', 'جناح ملكي (Royal Suite)', 'فيلا خاصة (Villa)'];
        $typeIds = [];
        foreach ($roomTypes as $typeName) {
            $typeIds[] = DB::table('room_types')->insertGetId([
                'name' => $typeName,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 4. خدمات الفندق (Amenities)
        $amenities = ['واي فاي مجاني', 'حمام سباحة', 'إفطار مجاني', 'تكييف هواء', 'إطلالة على البحر', 'صالة ألعاب رياضية (Gym)', 'سبا (Spa)', 'خدمة غرف 24/7', 'موقف سيارات'];
        $amenityIds = [];
        foreach ($amenities as $amenityName) {
            $amenityIds[] = DB::table('amenities')->insertGetId([
                'name' => $amenityName,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 5. توليد 30 فندق مختلف
        $hotelPrefixes = ['فندق', 'منتجع', 'جراند فندق', 'بنسيون'];
        $hotelNames = ['الماسة', 'هيلتون', 'شيراتون', 'فورسيزونز', 'ريتز كارلتون', 'موفنبيك', 'فلسطين', 'شتايجنبرجر', 'ماريوت', 'سوفيتيل', 'تيوليب', 'رويال'];

        for ($h = 1; $h <= 30; $h++) {
            $hotelName = $faker->randomElement($hotelPrefixes) . ' ' . $faker->randomElement($hotelNames) . ' ' . $h;
            
            $hotelId = DB::table('hotels')->insertGetId([
                'name' => $hotelName,
                'address' => $faker->streetAddress(),
                'rating' => $faker->randomFloat(1, 3, 5), // تقييم عشوائي بين 3.0 و 5.0
                'city_id' => $faker->randomElement($cityIds),
                'created_at' => now(), 'updated_at' => now(),
            ]);

            // توليد من 10 إلى 20 غرفة لكل فندق (المجموع كدة هيبقى اكتر من 400 غرفة!)
            $roomCount = rand(10, 20);
            for ($r = 1; $r <= $roomCount; $r++) {
                DB::table('rooms')->insert([
                    'room_number' => (string) ($h * 100 + $r),
                    'price_per_night' => $faker->numberBetween(500, 10000), // أسعار متدرجة من 500 لـ 10,000 ج.م
                    'hotel_id' => $hotelId,
                    'room_type_id' => $faker->randomElement($typeIds),
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
    }
}
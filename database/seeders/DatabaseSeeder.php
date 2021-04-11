<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SurfaceSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(PatternSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(HsCodeSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(SpecificationSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(ProductSeeder::class);
    }
}

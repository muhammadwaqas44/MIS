<?php

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
         $this->call(CountriesTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(ChannelTableSeeder::class);
         $this->call(DesignationTableSeeder::class);
         $this->call(ExperinceTableSeeder::class);
         $this->call(CallStatusTableSeeder::class);
         $this->call(MassegeTableSeeder::class);
         $this->call(DepartmentTableSeeder::class);
         $this->call(LocationOfficeTableSeeder::class);
         $this->call(EmploymentStatusSeeder::class);
         $this->call(EmployeeReviewTableSeeder::class);
         $this->call(ReviewAndEmploymentStatusSeeder::class);
         $this->call(LiveSessionWinnersSeeder::class);
         $this->call(PrizeTableSeeder::class);
         $this->call(ProfessionalTableSeeder::class);
         $this->call(ContactTypeTableSeeder::class);
         $this->call(PlatformTableSeeder::class);
         $this->call(CStatusesTableSeeder::class);
         $this->call(InventoryTableSeeder::class);
         $this->call(ExpTypeSeeder::class);
         $this->call(ExpCategorySeeder::class);

    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate the table
        Role::truncate();

        Role::create(['name' =>'admin']);
        Role::create(['name' =>'client']);
    }
}
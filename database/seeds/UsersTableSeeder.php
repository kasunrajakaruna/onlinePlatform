<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        try
        {
            DB::table('users')->truncate();

            $date = Carbon::now();

            DB::beginTransaction();

            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('admin'),
                'created_at' => $date,
                'updated_at' => $date,
                'role' => 'admin'
            ]);

            DB::table('users')->insert([
                'name' => 'Kasun',
                'email' => 'kasun@email.com',
                'password' => bcrypt('kasun'),
                'created_at' => $date,
                'updated_at' => $date,
                'role' => 'user'
            ]);

        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());

            DB::rollBack();
        }

        DB::commit();
    }
	
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(database_path('data/role.json')), true);

        foreach ($data as $value) {
            Role::updateOrCreate([
                'id' => $value['id']
            ], [
                'id' => $value['id'],
                'name' => $value['name'],
                'guard_name' => $value['guard_name']
            ]);
        }
        $this->command->info('Data role seed success');
    }
}

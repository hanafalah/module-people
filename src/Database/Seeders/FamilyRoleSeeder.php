<?php 

namespace Hanafalah\ModulePeople\Database\Seeders;

use Illuminate\Database\Seeder;

class FamilyRoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $familyRoleModel = app(config('database.models.FamilyRole'));

        $data = [
            ['name' => 'Anak', 'label' => 'Anak'],
            ['name' => 'Kakak', 'label' => 'Kakak'],
            ['name' => 'Adik', 'label' => 'Adik'],
            ['name' => 'Istri', 'label' => 'Istri'],
            ['name' => 'Suami', 'label' => 'Suami'],
            ['name' => 'Ayah', 'label' => 'Ayah'],
            ['name' => 'Ibu', 'label' => 'Ibu'],
            ['name' => 'Kakek', 'label' => 'Kakek'],
            ['name' => 'Nenek', 'label' => 'Nenek'],
            ['name' => 'Paman', 'label' => 'Paman'],
            ['name' => 'Tante', 'label' => 'Tante'],
        ];

        foreach ($data as $item) {
            $familyRoleModel::updateOrCreate([
                'name' => $item['name'],
                'flag' => 'FamilyRole',
                'label' => $item['label']
            ]);
        }
    }
}
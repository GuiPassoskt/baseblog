<?php

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $categories = [
            1 => 'Coberturas',
            2 => 'Texturas',
            3 => 'Tintas',
            4 => 'Selador'
        ];
        
        foreach ($categories as $id => $name) {

            $p = ProductCategory::firstOrNew(['id' => $id]);

            $p->fill(compact('name'))->save();
        }
    }
}

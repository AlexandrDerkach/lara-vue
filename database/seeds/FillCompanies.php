<?php

use Illuminate\Database\Seeder;
use App\Company;

class FillCompanies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $field = Company::find($i);
            if (is_null($field)) {
                $compamy = new Company();
                $compamy->id = $i;
                $compamy->name = 'Company №'.$i;
                $compamy->address = 'Kiev Grigorenka st. '.$i;
                $compamy->website = 'test-website'.$i.'.com';
                $compamy->email = 'test'.$i.'@test.com';
                $compamy->save();
            }
        }
    }
}

<?php namespace App\Database\Seeds;

class StartSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                $this->call('GejalaSeeder');
                $this->call('PenyakitSeeder');
                $this->call('RuleSeeder');
        }
}
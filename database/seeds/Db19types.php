<?php

use Illuminate\Database\Seeder;

class Db19types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_input_doc')->table('types')->insert(
            [
                [
                    'name' => 'confidential_input',
                    'ua_name' => 'Вхідні документи ДСК',
                    'description' => 'Облік вхідних документів ДСК'
                ],

                [
                    'name' => 'confidential_output',
                    'ua_name' => 'Вихідні документи ДСК',
                    'description' => 'Облік вихідних документів ДСК'
                ],

                [
                    'name' => 'confidential_inventory',
                    'ua_name' => 'Інвентарні ДСК',
                    'description' => 'Облік інвентарних ДСК'
                ],

                [
                    'name' => 'confidential_disk',
                    'ua_name' => 'Машинні носії інформації ДСК',
                    'description' => 'Облік машинних носіїв інформації ДСК'
                ],

                [
                    'name' => 'no_confidential_input',
                    'ua_name' => 'Нетаємні вхідні документи',
                    'description' => 'Облік нетаємних вхідних документів'
                ],

                [
                    'name' => 'no_confidential_output',
                    'ua_name' => 'Нетаємні вихідні документи',
                    'description' => 'Облік нетаємних вихідних документів'
                ],

                [
                    'name' => 'no_confidential_inventory',
                    'ua_name' => 'Нетаємні інвентарні',
                    'description' => 'Облік нетаємних інвентарних'
                ],

                [
                    'name' => 'no_confidential_disk',
                    'ua_name' => 'Нетаємні машинні носії інформації',
                    'description' => 'Облік нетаємних машинних носіїв інформації'
                ],
            ]
        );
    }
}

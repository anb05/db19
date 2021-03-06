<?php

use Illuminate\Database\Seeder;

class Db19States extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_input_doc')->table('states')->insert(
            [
                [
                    'name' => 'draft',
                    'description' => 'Початковий стан запису до бази даних. Призначається автоматично при першому 
                                      заповненню електронної форми користувачем з роллю writer. При цьому запис не
                                      відображається для інших користувачів інформаційного ресурсу. 
                                      Її можуть переглянути тільки модератори та користувач, який її зробив.'
                ],

                [
                    'name' => 'prepared',
                    'description' => 'Стан запису, коли всі поля електронної форми правильно заповненні. 
                                      Запис в цьому стані підлягає верифікації користувачем з роллю moderator. 
                                      У випадку, коли в оформленні запису є відхилення від вимог, 
                                      модератор переводить запис у стан draft. В такому випадку, 
                                      користувач з роллю writer повинен внести у запис відповідні 
                                      корективи й перевести запис у стан prepared для його повторної перевірки. 
                                      Якщо запис пройшов перевірку, moderator визначає групи для його перегляду.'
                ],

                [
                    'name' => 'checked',
                    'description' => 'Стан запису, коли всі поля електронної форми правильно заповненні, 
                                      групи для перегляду визначені. У цьому стані запис знаходиться постійно
                                      до моменту його видалення або внесення змін з будь яких причин.'
                ],
            ]
        );
    }
}

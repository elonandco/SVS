<?php

class QuestionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('questions')->delete();

         DB::table('questions')->insert(array(
         	array(
                'text'      => 'How satisfied were you with the customer service provided'
            ),
            array(
                'text'      => 'How satisfied were you with the timeliness of the service provided'
            ),
            array(
                'text'      => 'How satisfied were you with the quality of the service provided'
            ),
            array(
                'text'      => 'How satisfied were you with the quality of the service provided'
            )
         ));

    }
}
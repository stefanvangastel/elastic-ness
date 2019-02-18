<?php

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$faker  = Faker\Factory::create('nl_NL');

//Start looping, CTRL + C to end..
while (true == true) {


	$date = $faker->dateTimeBetween("-2 years", "now");

	//Persistent data
	$params = [
	    'index' => 'ness',
		'type' => '_doc',
	    'body' => [
	    	"timestamp" => date('Y-m-d H:i:s', $date->getTimestamp() ),
			"account" => $faker->bothify('a#?###')
	    ]
	];

	//Application
	$params['body']['application'] = $faker->randomElement(['HotNoHat','LRB' ]);


	//Random data per application
	switch ($params['body']['application']) {
		
		case 'HotNoHat':
			
			//Random data per type
			$params['body']['type'] = $faker->randomElement(['persoon','kenteken','document']);

			//Random data per type
			switch ($params['body']['type']) {

				case 'persoon':
						$params['body']['voorletter'] = strtoupper($faker->randomLetter());
						$params['body']['achternaam'] = $faker->lastName();
						$params['body']['gebdat'] = $faker->date('d-m-Y');
					break;

				case 'kenteken':
						$params['body']['kenteken'] = $faker->regexify('[[A-Z0-9]{6}');
					break;

				case 'document':
						$params['body']['documentnummer'] = $faker->randomNumber(9);
						$params['body']['documentsoort'] = $faker->randomElement(['P','I','V']);
						$params['body']['landuitgifte'] = $faker->countryCode();
					break;

			}

			break;

		case 'LRB':

			//Random data per type
			$params['body']['type'] = $faker->randomElement(['prominent','verdachte','download']);

			//Random data per type
			switch ($params['body']['type']) {

				case 'prominent':
						$params['body']['naam'] = $faker->name();
					break;

				case 'verdachte':
						$params['body']['naam'] = $faker->name();
					break;

				case 'download':
						$params['body']['download'] = $faker->randomElement([
							'briefing_01-01-2019.pdf',
							'ontruimings_procedure.pdf',
							'ct_instructie.pdf',
							'werkinstructie_locatieX.pdf',
							'briefing_02-01-2019.pdf',
							'briefing_03-01-2019.pdf',
							'briefing_01-02-2019.pdf',
							'briefing_22-01-2019.pdf',
							'briefing_23-01-2019.pdf',
							'briefing_02-02-2019.pdf'
						]);
					break;
			}

			break;
		
		default:
			break;
	}


	$response = $client->index($params);

	print_r($response);

}

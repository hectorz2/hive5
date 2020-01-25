<?php

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

// @see https://www.back4app.com/database/back4app/list-of-all-continents-countries-cities

/* region COUNTRY AND CITY */

$countryLine = '$this->addSql("INSERT INTO country (english_name, native_name) VALUES (\'%englishName%\', \'%nativeName%\')");';
$cityLine = '$this->addSql("INSERT INTO city (country_id, name) VALUES (%countryId%, \'%name%\')");';

$client = HttpClient::create();
$response = $client->request('GET', 'https://parseapi.back4app.com/classes/Continentscountriescities_Country', [
    'headers' => [
        'X-Parse-Application-Id' => '*',
        'X-Parse-REST-API-Key' => '*'
    ]
]);

$countries = $response->toArray();
$countryLines = [];
$citiesLines = [];

$nonCities = [];
$i = 0;
foreach ($countries['results'] as $country) {
    $countryId = $i + 1;
    $englishName = str_replace("'", "\'", $country['name']);
    $nativeName = str_replace("'", "\'", $country['native']);

    $client = HttpClient::create();
    $response = $client->request('GET', 'https://parseapi.back4app.com/classes/Continentscountriescities_City', [
        'headers' => [
            'X-Parse-Application-Id' => '*',
            'X-Parse-REST-API-Key' => '*'
        ],
        'query' => [
            'where' => json_encode([
                'country' => [
                    '__type' => 'Pointer',
                    'className' => 'Continentscountriescities_Country',
                    'objectId' => $country['objectId']
                ]
            ])
        ]
    ]);

    $cities = $response->toArray();
    if(sizeof($cities['results']) == 0) {
        $nonCities[] = $englishName;
    } else {
        $toReplace = [
            '%englishName%',
            '%nativeName%'
        ];
        $replaces = [
            $englishName,
            $nativeName
        ];
        $line = str_replace($toReplace, $replaces, $countryLine);
        $countryLines[] = $line;

        foreach ($cities['results'] as $city) {
            $name = str_replace("'", "\'", $city['name']);
            $toReplace = [
                '%name%',
                '%countryId%'
            ];
            $replaces = [
                $name,
                $countryId
            ];
            $line = str_replace($toReplace, $replaces, $cityLine);
            $citiesLines[] = $line;
        }

        $i += 1;
    }
}

//$html = implode(', ', $nonCities) . '<br/><br/>';
//$html .= implode('<br/>', $countryLines);
//$html .= '<br/><br/><br/>';
//$html .= implode('<br/>', $citiesLines);
//return new Response($html);

/* endregion */

/* region LANGUAGE */

$languageLine = '$this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES (\'%englishName%\', \'%nativeName%\', \'%isoCode%\')");';

$client = HttpClient::create();
$response = $client->request('GET', 'https://parseapi.back4app.com/classes/Continentscountriescities_Language', [
    'headers' => [
        'X-Parse-Application-Id' => '*',
        'X-Parse-REST-API-Key' => '*'
    ]
]);

$languages = $response->toArray();
$languageLines = [];

foreach ($languages['results'] as $language) {
    $englishName = str_replace("'", "\'", $language['name']);
    $nativeName = str_replace("'", "\'", $language['native']);
    $isoCode = $language['code'];

    $toReplace = [
        '%englishName%',
        '%nativeName%',
        '%isoCode%'
    ];
    $replaces = [
        $englishName,
        $nativeName,
        $isoCode
    ];
    $line = str_replace($toReplace, $replaces, $languageLine);
    $languageLines[] = $line;
}

//$html = implode('<br/>', $languageLines);

/* endregion */

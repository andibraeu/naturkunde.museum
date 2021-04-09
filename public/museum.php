<?php

class SPARQLQueryDispatcher
{
    private $endpointUrl;

    public function __construct(string $endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;
    }

    public function query(string $sparqlQuery): string
    {

        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'Accept: application/sparql-results+json',
                    'User-Agent: WDQS-example PHP/' . PHP_VERSION, // TODO adjust this; see https://w.wiki/CX6
                ],
            ],
        ];
        $context = stream_context_create($opts);

        $url = $this->endpointUrl . '?query=' . urlencode($sparqlQuery);
        $response = file_get_contents($url, false, $context);
        return $response;
    }
}

$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< 'SPARQL'
#Alle naturkundemussen in Deutschland
SELECT DISTINCT ?item ?name ?lat ?lon ?website ?phone ?email ?twitter ?facebook ?image ?logo ?address ?thumb WHERE {
  hint:Query hint:optimizer "None".
  ?item (wdt:P131*) wd:Q183;
    (wdt:P31/(wdt:P279*)) wd:Q1970365;
    p:P625 ?coordinate.
  ?coordinate psv:P625 ?coordinate_node.
  ?coordinate_node wikibase:geoLatitude ?lat;
    wikibase:geoLongitude ?lon.
  SERVICE wikibase:label {
    bd:serviceParam wikibase:language "de".
    ?item rdfs:label ?name.
  }
  OPTIONAL { ?item wdt:P856 ?website. }
  OPTIONAL { ?item wdt:P2002 ?twitter. }
  OPTIONAL { ?item wdt:P2013 ?facebook. }
  OPTIONAL { ?item wdt:P18 ?image. }
  OPTIONAL { ?item wdt:P1329 ?phone. }
  OPTIONAL { ?item wdt:P968 ?email. }
  OPTIONAL { ?item wdt:P6375 ?address. }
  OPTIONAL { ?item wdt:P154 ?logo. }

  BIND(REPLACE(wikibase:decodeUri(STR(?image)), "http://commons.wikimedia.org/wiki/Special:FilePath/", "") as ?fileName) .
  BIND(REPLACE(?fileName, " ", "_") as ?safeFileName)
  BIND(MD5(?safeFileName) as ?fileNameMD5) .
  BIND(CONCAT("https://upload.wikimedia.org/wikipedia/commons/thumb/", SUBSTR(?fileNameMD5, 1, 1), "/", SUBSTR(?fileNameMD5, 1, 2), "/", ?safeFileName, "/150px-", ?safeFileName) as ?thumb)

}
ORDER BY (?name)
SPARQL;

$queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
$queryResult = $queryDispatcher->query($sparqlQueryString);
if (isset($queryResult) === true && trim($queryResult !== '')) {
  file_put_contents(getcwd() . "/httpdocs/data/data.json", $queryResult);
}

?>

<?php
namespace App\Service;
use Symfony\Component\HttpClient\HttpClient;

class swApi
{
	CONST END_POINTS = [
		"people" => "https://swapi.co/api/people/", 
		"planets" => "https://swapi.co/api/planets/", 
		"films" => "https://swapi.co/api/films/", 
		"species" => "https://swapi.co/api/species/", 
		"vehicles" => "https://swapi.co/api/vehicles/", 
		"starships" => "https://swapi.co/api/starships/"
	];

	protected function sendRequest($url, $method = 'GET') {
		$client = HttpClient::create();
		$response = $client->request($method, $url);
		$statusCode = $response->getStatusCode();
		
		if ($statusCode != 200) {
			throw new \Exception ('Failed request for :' . $url);
		}
		// $statusCode = 200
		$contentType = $response->getHeaders()['content-type'][0];
		// $contentType = 'application/json'
		$content = $response->getContent();
		// $content = '{"id":521583, "name":"symfony-docs", ...}'
		$content = $response->toArray();
		return $content;
	}

	public function getJediCharacters() {
		$result = $this->sendRequest(self::END_POINTS['people']);

		if (!isset($result['results']) OR count($result['results']) == 0) {
			throw new \Exception ("Jedi characters not found");
		}
		
		return $result["results"];
	}

	public function getSpecies($field, $value) {

		$result = $this->sendRequest(self::END_POINTS['species']);

		if (!isset($result['results']) OR count($result['results']) == 0) {
			throw new \Exception ("No species found");
		}
		
		$result = $result["results"];
		return $this->filterResult($result, $field, $value);
		
	}

	public function filterResult($results, $key, $value) {

		$filteredResult = [];
		foreach($results as $result) {
			if (strtolower($result[$key]) == strtolower($value)) {
				$filteredResult[] = $result;
			}		
		}

		return $filteredResult;
	}

	public function getHomeWorld($species) {
		foreach ($species as $key=>$specie) {
			$result = $this->sendRequest($specie['homeworld']);
			$species[$key]['homeworld'] = $result['name'];
		}

		return $species;
	}

}
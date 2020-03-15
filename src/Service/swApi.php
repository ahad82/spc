<?php
namespace App\Service;
use Symfony\Component\HttpClient\HttpClient;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\SwapiCharacter;
use App\Entity\UpdatedCharacterData;

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
		
		$this->log("sending request to swapi for url: {$url}");
		if ($statusCode != 200) {
			$this->log("Failed request for {$url}");
			throw new \Exception ("Failed request for {$url}");
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

	public function importJediCharacters($em) {
		$results = $this->getJediCharacters();
		$results = $this->getHomeWorld($results);
		
		foreach ($results as $result) {
			$character = new SwapiCharacter();
			$character->name = $result['name'];
			$character->height = $result['height'];
			$character->mass = $result['mass'];
			$character->hairColor = $result['hair_color'];
			$character->birthYear = $result['birth_year'];
			
			$character->gender = $result['gender'];
			$character->homeworldName = $result['homeworld'];
			$this->log("getting species now for {$character->name}..");
			$species = $this->sendRequest($result['species'][0]);
			$character->speciesName = $species['name'];
			
			$em->persist($character);
			$em->flush();
		}
	}

	public function updateCharacters($em) {
		$fromRepo = $em->getRepository(UpdatedCharacterData::class);
		$toRepo = $em->getRepository(SwapiCharacter::class);
		$uchars = $fromRepo->findAll();

		foreach ($uchars as $uchar) {
			$character = $toRepo->findBy(['name' => $uchar->name]);
			if (!$character) {
				$this->log("Character {$uchar->name} not found in current swapi characters");
				continue;
			}
			$character = $character[0];
			
			$this->log("Updating {$uchar->name}...");
			$character->name = $uchar->name;
			$character->height = $uchar->height;
			$character->mass = $uchar->mass;
			$character->hairColor = $uchar->hairColor;
			$character->birthYear = $uchar->birthYear;
			$character->gender = $uchar->gender;
			$character->homeworldName = $uchar->homeworldName;
			$character->speciesName = $uchar->speciesName;

			$em->persist($character);
			$em->flush();

		}
	}

	public function log($msg) {
		error_log($msg);
	}

}
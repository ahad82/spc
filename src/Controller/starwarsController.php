<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

use App\Service\swApi;

class starwarsController extends AbstractController
{
    protected $swApi;

    public function __construct(swApi $api)
    {
        $this->swApi = $api;
    }
   /**
     * @Route("/starwars", name="starwars_list")
     */
   public function list()
   {
        //$connection = $this->getDoctrine()->getConnection();
        //$result = $connection->fetchAll('SELECT * FROM swapi_character');

    $userFirstName = 'test';
    $userNotifications = 'last';
    return $this->render('index/index.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
        'user_first_name' => $userFirstName,
        'notifications' => $userNotifications,
    ]);
}

    /**
     * @Route("/starwars/jedi/characters", name="starwars_jedi_characters")
     */
    public function getJediCharacters() {

        $error = false;
        $errorMsg = '';
        $result = [];
        try {
            $result = $this->swApi->getJediCharacters();

        } catch (\Exception $e) {
            //log here
            $error = true;
            $errorMsg = $e->getMessage();

        }
        return $this->render('index/characters_jedi.html.twig', [
            'error' => $error,
            'errorMsg' => $errorMsg,
            'result' => $result,
        ]);
    }

    /**
     * @Route("/starwars/species/mammal", name="starwars_species_mammal")
     */
    public function getMammalSpecies() {
        $error = false;
        $errorMsg = '';
        $result = [];
        try {
            $result = $this->swApi->getSpecies('classification', 'Mammal');
                //append home world here
            $result = $this->swApi->getHomeWorld($result);


        } catch (\Exception $e) {
            //log here
            $error = true;
            $errorMsg = $e->getMessage();

        }

        return $this->render('index/mammal_homeworlds.html.twig', [
            'error' => $error,
            'errorMsg' => $errorMsg,
            'result' => $result,
        ]);
    }


    /**
     * @Route("/starwars/characters/import", name="import_characters")
     */
    public function importCharacters() {

        $em = $this->getDoctrine()->getManager();
        $error = false;
        $errorMsg = '';
        $result = [];
        try {
            $result = $this->swApi->importJediCharacters($em);

        } catch (\Exception $e) {
            //log here
            $error = true;
            $errorMsg = $e->getMessage();

        }
        return $this->render('index/characters_jedi.html.twig', [
            'error' => $error,
            'errorMsg' => $errorMsg,
            'result' => $result,
        ]);
    }

    /**
     * @Route("/starwars/characters/update", name="update_characters")
     */
    public function updateCharacters() {

        $em = $this->getDoctrine()->getManager();
        $error = false;
        $errorMsg = '';
        $result = [];
        try {
            $result = $this->swApi->updateCharacters($em);

        } catch (\Exception $e) {
            //log here
            $error = true;
            $errorMsg = $e->getMessage();

        }
        return $this->render('index/characters_jedi.html.twig', [
            'error' => $error,
            'errorMsg' => $errorMsg,
            'result' => $result,
        ]);
    }
}
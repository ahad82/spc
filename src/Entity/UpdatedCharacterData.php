<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UpdatedCharacterData
 *
 * @ORM\Table(name="updated_character_data")
 * @ORM\Entity
 */
class UpdatedCharacterData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    public $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="height", type="string", length=45, nullable=true)
     */
    public $height;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mass", type="string", length=45, nullable=true)
     */
    public $mass;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hair_color", type="string", length=45, nullable=true)
     */
    public $hairColor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="birth_year", type="string", length=45, nullable=true)
     */
    public $birthYear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gender", type="string", length=45, nullable=true)
     */
    public $gender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="homeworld_name", type="string", length=45, nullable=true)
     */
    public $homeworldName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="species_name", type="string", length=45, nullable=true)
     */
    public $speciesName;

}

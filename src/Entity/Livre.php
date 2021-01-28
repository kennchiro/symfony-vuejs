<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\LivreRepository")
 */
class Livre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titlelivre;

    /**
     * @ORM\Column(type="text")
     */
    private $edition;

    /**
     * @ORM\Column(type="integer")
     */
    private $taille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitlelivre(): ?string
    {
        return $this->titlelivre;
    }

    public function setTitlelivre(string $titlelivre): self
    {
        $this->titlelivre = $titlelivre;

        return $this;
    }

    public function getEdition(): ?string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): self
    {
        $this->edition = $edition;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }
}

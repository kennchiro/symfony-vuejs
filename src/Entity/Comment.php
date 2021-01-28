<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $textcom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $persocom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="comment")
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextcom(): ?string
    {
        return $this->textcom;
    }

    public function setTextcom(string $textcom): self
    {
        $this->textcom = $textcom;

        return $this;
    }

    public function getPersocom(): ?string
    {
        return $this->persocom;
    }

    public function setPersocom(string $persocom): self
    {
        $this->persocom = $persocom;

        return $this;
    }


    public function getDatecom(): ?\DateTimeInterface
    {
        return $this->datecom;
    }

    public function setDatecom(\DateTimeInterface $datecom): self
    {
        $this->datecom = $datecom;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}

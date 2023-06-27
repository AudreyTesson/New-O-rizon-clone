<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     */
    private $city;

    /**
     * @ORM\OneToOne(targetEntity=Country::class, mappedBy="image", cascade={"persist", "remove"})
     */
    private $country;

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        // unset the owning side of the relation if necessary
        if ($country === null && $this->country !== null) {
            $this->country->setImage(null);
        }

        // set the owning side of the relation if necessary
        if ($country !== null && $country->getImage() !== $this) {
            $country->setImage($this);
        }

        $this->country = $country;

        return $this;
    }

}

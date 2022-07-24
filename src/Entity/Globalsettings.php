<?php

namespace App\Entity;

use App\Repository\GlobalsettingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GlobalsettingsRepository::class)
 */
class Globalsettings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closeWebsite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $frames;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zoom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxItems;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closeRegister;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCloseWebsite(): ?bool
    {
        return $this->closeWebsite;
    }

    public function setCloseWebsite(?bool $closeWebsite): self
    {
        $this->closeWebsite = $closeWebsite;

        return $this;
    }

    public function getFrames(): ?int
    {
        return $this->frames;
    }

    public function setFrames(?int $frames): self
    {
        $this->frames = $frames;

        return $this;
    }

    public function getZoom(): ?int
    {
        return $this->zoom;
    }

    public function setZoom(?int $zoom): self
    {
        $this->zoom = $zoom;

        return $this;
    }

    public function getMaxItems(): ?int
    {
        return $this->maxItems;
    }

    public function setMaxItems(?int $maxItems): self
    {
        $this->maxItems = $maxItems;

        return $this;
    }

    public function isCloseRegister(): ?bool
    {
        return $this->closeRegister;
    }

    public function setCloseRegister(?bool $closeRegister): self
    {
        $this->closeRegister = $closeRegister;

        return $this;
    }
}

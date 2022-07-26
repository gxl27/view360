<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
  * @Vich\Uploadable
 */
class Category
{
    const EXTENSIONS = [
        'jpeg', 'jpg', 'png'
    ];

    const STATE = [
        0 => 'unavailable',
        1 => 'available',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $state;

     /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     * @var string
     */
    private $document;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @Vich\UploadableField(mapping="category_images", fileNameProperty="document")
     * @var File
     */
    private $categoryImages;

    /**
     * @ORM\OneToMany(targetEntity=Variant::class, mappedBy="category")
     */
    private $variants;

    public function __construct()
    {
        $this->state = 1;
        $this->variants = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getStateFormated(){

        return SELF::STATE[$this->getState()];

    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setcategoryImages(File $document = null)
    {
        $this->categoryImages = $document;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($this->categoryImages instanceof UploadedFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime();
        }
    }

    public function getcategoryImages()
    {
        return $this->categoryImages;
    }

    public function getExtension(){

        $doc = $this->getDocument();
        $extension = pathinfo($doc, PATHINFO_EXTENSION);

        return $extension;
    }

    public function checkValidExtension($file){
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if(!in_array($extension, SELF::EXTENSIONS)){
            return 0;
        }
        return $extension;
    }

    /**
     * @return Collection<int, Variant>
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->variants->contains($variant)) {
            $this->variants[] = $variant;
            $variant->setCategory($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getCategory() === $this) {
                $variant->setCategory(null);
            }
        }

        return $this;
    }
}

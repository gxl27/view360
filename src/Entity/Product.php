<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable
 */
class Product
{
    const EXTENSIONS = [
        'jpeg', 'jpg', 'png'
    ];
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;


    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     * @var string
     */
    private $document;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="document")
     * @var File
     */
    private $productImages;

    /**
     * @ORM\ManyToOne(targetEntity=Variant::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $variant;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $color;

    public function __construct()
    {
        $this->status = 1;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
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

    public function setProductImages(File $document = null)
    {
        $this->productImages = $document;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($this->productImages instanceof UploadedFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime();
        }
    }

    public function getProductImages()
    {
        return $this->productImages;
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


    public function getVariant(): ?Variant
    {
        return $this->variant;
    }

    public function setVariant(?Variant $variant): self
    {
        $this->variant = $variant;

        return $this;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): self
    {
        $this->color = $color;

        return $this;
    }
}

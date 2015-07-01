<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Building
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BuildingRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Building
{
    public static $operationTypeOptions = array('venta' => 'Venta', 'alquiler' => 'Alquiler');

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=50)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyType")
     * @ORM\JoinColumn(name="property_type_id", referencedColumnName="id")
     */
    private $propertyType;

    /**
     * @var string
     *
     * @ORM\Column(name="neighborhood", type="string", length=255, nullable=true)
     */
    private $neighborhood;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="featured", type="boolean")
     */
    private $featured;

    /**
     * @var string
     *
     * @ORM\Column(name="services", type="text", nullable=true)
     */
    private $services;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="operationType", type="string", length=255)
     */
    private $operationType;

    /**
     * @var integer
     *
     * @ORM\Column(name="frontMts", type="integer", nullable=true)
     */
    private $frontMts;

    /**
     * @var integer
     *
     * @ORM\Column(name="backMts", type="integer", nullable=true)
     */
    private $backMts;

    /**
     * @var integer
     *
     * @ORM\Column(name="surfaceM2", type="integer", nullable=true)
     */
    private $surfaceM2;

    /**
     * @var integer
     *
     * @ORM\Column(name="coveredSurface", type="integer", nullable=true)
     */
    private $coveredSurface;

    /**
     * @var integer
     *
     * @ORM\Column(name="semicoveredSurface", type="integer", nullable=true)
     */
    private $semicoveredSurface;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="building", cascade={"persist"}, orphanRemoval=true)
     */
    protected $images;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"reference"}, updatable=false, separator="-")
     */
    private $slug;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;


    /*** Magic methods ***/
    /**
     * __construct() method
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * __toString() method
     */
    public function __toString()
    {
        return $this->getReference();
    }
    /*** END Magic methods ***/


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Building
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set location
     *
     * @param integer $location
     * @return Building
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return integer 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Building
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set propertyType
     *
     * @param integer $propertyType
     * @return Building
     */
    public function setPropertyType($propertyType)
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    /**
     * Get propertyType
     *
     * @return integer 
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    /**
     * Set neighborhood
     *
     * @param string $neighborhood
     * @return Building
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * Get neighborhood
     *
     * @return string 
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Set detail
     *
     * @param string $detail
     * @return Building
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string 
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Building
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     * @return Building
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean 
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set services
     *
     * @param string $services
     * @return Building
     */
    public function setServices($services)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * Get services
     *
     * @return string 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Building
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set operationType
     *
     * @param string $operationType
     * @return Building
     */
    public function setOperationType($operationType)
    {
        $this->operationType = $operationType;

        return $this;
    }

    /**
     * Get operationType
     *
     * @return string 
     */
    public function getOperationType()
    {
        return $this->operationType;
    }

    /**
     * Set frontMts
     *
     * @param integer $frontMts
     * @return Building
     */
    public function setFrontMts($frontMts)
    {
        $this->frontMts = $frontMts;

        return $this;
    }

    /**
     * Get frontMts
     *
     * @return integer 
     */
    public function getFrontMts()
    {
        return $this->frontMts;
    }

    /**
     * Set backMts
     *
     * @param integer $backMts
     * @return Building
     */
    public function setBackMts($backMts)
    {
        $this->backMts = $backMts;

        return $this;
    }

    /**
     * Get backMts
     *
     * @return integer 
     */
    public function getBackMts()
    {
        return $this->backMts;
    }

    /**
     * Set surfaceM2
     *
     * @param integer $surfaceM2
     * @return Building
     */
    public function setSurfaceM2($surfaceM2)
    {
        $this->surfaceM2 = $surfaceM2;

        return $this;
    }

    /**
     * Get surfaceM2
     *
     * @return integer 
     */
    public function getSurfaceM2()
    {
        return $this->surfaceM2;
    }

    /**
     * Set coveredSurface
     *
     * @param integer $coveredSurface
     * @return Building
     */
    public function setCoveredSurface($coveredSurface)
    {
        $this->coveredSurface = $coveredSurface;

        return $this;
    }

    /**
     * Get coveredSurface
     *
     * @return integer 
     */
    public function getCoveredSurface()
    {
        return $this->coveredSurface;
    }

    /**
     * Set semicoveredSurface
     *
     * @param integer $semicoveredSurface
     * @return Building
     */
    public function setSemicoveredSurface($semicoveredSurface)
    {
        $this->semicoveredSurface = $semicoveredSurface;

        return $this;
    }

    /**
     * Get semicoveredSurface
     *
     * @return integer 
     */
    public function getSemicoveredSurface()
    {
        return $this->semicoveredSurface;
    }

    /**
     * Add images
     *
     * @param \AppBundle\Entity\Media $images
     * @return Building
     */
    public function addImage(\AppBundle\Entity\Media $images)
    {
        $images->setBuilding($this);
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \AppBundle\Entity\Media $images
     */
    public function removeImage(\AppBundle\Entity\Media $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Building
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Building
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * setLatLng() method
     */
    public function setLatLng($latlng)
    {
        $this->setLatitude($latlng['lat']);
        $this->setLongitude($latlng['lng']);
        return $this;
    }

    /**
     * getLatLng() method
     */
    public function getLatLng()
    {
        return array('lat'=>$this->getLatitude(),'lng'=>$this->getLongitude());
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Building
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Building
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Building
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}

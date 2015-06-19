<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Auction
 *
 * @ORM\Table(name="auction")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Auction
{
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="possessions", type="text", nullable=true)
     */
    private $possessions;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @var datetime
     *
     * @ORM\Column(name="pdf_updated", type="datetime", nullable=true)
     */
    private $pdfUpdated;

    /**
     * @var string
     *
     * @ORM\Column(name="locality", type="string", length=255)
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions", type="text", nullable=true)
     */
    private $conditions;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="auction", cascade={"persist"}, orphanRemoval=true)
     */
    protected $images;

    /**
     * Unmapped field ("virtual")
     * @Assert\File(maxSize="6000000", mimeTypes="application/pdf")
     */
    private $file;


    /*** Magic methods ***/
    /**
     * __toString()
     */
    public function __toString()
    {
        return $this->getTitle();
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
     * Set title
     *
     * @param string $title
     * @return Auction
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set possessions
     *
     * @param string $possessions
     * @return Auction
     */
    public function setPossessions($possessions)
    {
        $this->possessions = $possessions;

        return $this;
    }

    /**
     * Get possessions
     *
     * @return string 
     */
    public function getPossessions()
    {
        return $this->possessions;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Auction
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Auction
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
     * Set pdf
     *
     * @param string $pdf
     * @return Auction
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string 
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set locality
     *
     * @param string $locality
     * @return Auction
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return string 
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set conditions
     *
     * @param string $conditions
     * @return Auction
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string 
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set pdfUpdated
     *
     * @param \DateTime $pdfUpdated
     * @return Auction
     */
    public function setPdfUpdated($pdfUpdated)
    {
        $this->pdfUpdated = $pdfUpdated;

        return $this;
    }

    /**
     * Get pdfUpdated
     *
     * @return \DateTime 
     */
    public function getPdfUpdated()
    {
        return $this->pdfUpdated;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->pdf)) {
            // store the old name to delete after the update
            $this->temp = $this->pdf;
            $this->pdf = null;
        } else {
            $this->pdf = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * getAbsolutePath() method
     */
    public function getAbsolutePath()
    {
        return null === $this->pdf
            ? null
            : $this->getUploadRootDir().'/'.$this->pdf;
    }

    /**
     * getWebPath() method
     */
    public function getWebPath()
    {
        return null === $this->pdf
            ? null
            : $this->getUploadDir().'/'.$this->pdf;
    }

    /**
     * getUploadRootDir() method
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    /**
     * getUploadDir() method
     */
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    /**
     * preUpload() method
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->pdf = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * upload() method
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->pdf);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    /**
     * Updates the hash value to force the preUpdate and postUpdate events to fire
     */
    public function refreshPdfUpdated()
    {
        $this->setPdfUpdated(new \DateTime("now"));
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add images
     *
     * @param \AppBundle\Entity\Media $images
     * @return Auction
     */
    public function addImage(\AppBundle\Entity\Media $images)
    {
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
     * Add localityImages
     *
     * @param \AppBundle\Entity\Media $localityImages
     * @return Auction
     */
    public function addLocalityImage(\AppBundle\Entity\Media $localityImages)
    {
        $this->localityImages[] = $localityImages;

        return $this;
    }

    /**
     * Remove localityImages
     *
     * @param \AppBundle\Entity\Media $localityImages
     */
    public function removeLocalityImage(\AppBundle\Entity\Media $localityImages)
    {
        $this->localityImages->removeElement($localityImages);
    }

    /**
     * Get localityImages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalityImages()
    {
        return $this->localityImages;
    }
}

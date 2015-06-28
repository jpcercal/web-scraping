<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Entity;

use Cekurte\ComponentBundle\Service\ResourceManager\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * Feed
 *
 * @ORM\Table(name="feed", indexes={
 *   @ORM\Index(name="url",    columns={"url"}),
 *   @ORM\Index(name="outlet", columns={"outlet_id"})
 * })
 * @ORM\Entity
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable
 */
class Feed implements ResourceInterface
{
    use SoftDeleteableEntity;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false, unique=true)
     */
    private $url;

    /**
     * @var Outlet
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(targetEntity="Outlet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="outlet_id", referencedColumnName="id")
     * })
     */
    private $outlet;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Feed
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
     * @return Feed
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
     * Set url
     *
     * @param string $url
     * @return Feed
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set outlet
     *
     * @param \Cekurte\WebScrapingBundle\Entity\Outlet $outlet
     * @return Feed
     */
    public function setOutlet(\Cekurte\WebScrapingBundle\Entity\Outlet $outlet = null)
    {
        $this->outlet = $outlet;

        return $this;
    }

    /**
     * Get outlet
     *
     * @return \Cekurte\WebScrapingBundle\Entity\Outlet 
     */
    public function getOutlet()
    {
        return $this->outlet;
    }
}

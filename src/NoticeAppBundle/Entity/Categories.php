<?php
namespace NoticeAppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="NoticeAppBundle\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="Notice", mappedBy="category")
     */
    private $notice;
    public function __construct() {
        $this->notice = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Add notice
     *
     * @param \NoticeAppBundle\Entity\Notice $notice
     *
     * @return Categories
     */
    public function addNotice(\NoticeAppBundle\Entity\Notice $notice)
    {
        $this->notice[] = $notice;
        return $this;
    }
    /**
     * Remove notice
     *
     * @param \NoticeAppBundle\Entity\Notice $notice
     */
    public function removeNotice(\NoticeAppBundle\Entity\Notice $notice)
    {
        $this->notice->removeElement($notice);
    }
    /**
     * Get notice
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotice()
    {
        return $this->notice;
    }
}

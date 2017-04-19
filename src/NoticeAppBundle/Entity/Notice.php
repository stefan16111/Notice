<?php
namespace NoticeAppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Notice
 *
 * @ORM\Table(name="notice")
 * @ORM\Entity(repositoryClass="NoticeAppBundle\Repository\NoticeRepository")
 */
class Notice
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expirationDate", type="datetime")
     */
    private $expirationDate;
    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="notice")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="notice")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="notice")
     */
    private $comments;
    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Notice
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
     * Set description
     *
     * @param string $description
     *
     * @return Notice
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
     * Set photo
     *
     * @param string $photo
     *
     * @return Notice
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }
    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return Notice
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }
    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }
    /**
     * Set category
     *
     * @param \NoticeAppBundle\Entity\Categories $category
     *
     * @return Notice
     */
    public function setCategory(\NoticeAppBundle\Entity\Categories $category = null)
    {
        $this->category = $category;
        return $this;
    }
    /**
     * Get category
     *
     * @return \NoticeAppBundle\Entity\Categories
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Add comment
     *
     * @param \NoticeAppBundle\Entity\Comment $comment
     *
     * @return Notice
     */
    public function addComment(\NoticeAppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
        return $this;
    }
    /**
     * Remove comment
     *
     * @param \NoticeAppBundle\Entity\Comment $comment
     */
    public function removeComment(\NoticeAppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }
    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
     * Set user
     *
     * @param \NoticeAppBundle\Entity\User $user
     *
     * @return Notice
     */
    public function setUser(\NoticeAppBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return \NoticeAppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

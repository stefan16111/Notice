<?php
namespace NoticeAppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="NoticeAppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="Notice", mappedBy="user")
     */
    private $notice;
    public function __construct()
    {
        parent::__construct();
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
     * Add notice
     *
     * @param \NoticeAppBundle\Entity\Notice $notice
     *
     * @return User
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

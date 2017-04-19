<?php
namespace NoticeAppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="NoticeAppBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;
    /**
     * @ORM\ManyToOne(targetEntity="Notice", inversedBy="comments")
     * @ORM\JoinColumn(name="notice_id", referencedColumnName="id")
     */
    private $notice;
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
     * Set text
     *
     * @param string $text
     *
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    /**
     * Set notice
     *
     * @param \NoticeAppBundle\Entity\Notice $notice
     *
     * @return Comment
     */
    public function setNotice(\NoticeAppBundle\Entity\Notice $notice = null)
    {
        $this->notice = $notice;
        return $this;
    }
    /**
     * Get notice
     *
     * @return \NoticeAppBundle\Entity\Notice
     */
    public function getNotice()
    {
        return $this->notice;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 * @Vich\Uploadable()
 */
class Posts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="first_name")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="name")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $thumbnail;

    /**
     * @Vich\UploadableField(mapping="post_thumbnails", fileNameProperty="thumbnail")
     */
    private $thumbnailFile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;



    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published): void
    {
        $this->published = $published;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

//    public function getBanner(): ?string
//    {
//        return $this->banner;
//    }
//
//    public function setBanner($banner): self
//    {
//        $this->banner = $banner;
//
//        return $this;
//    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }


    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

//    /**
//     * @return mixed
//     */
//    public function getNumberOfComments()
//    {
//        return $this->numberOfComments;
//    }
//
//    /**
//     * @param mixed $numberOfComments
//     */
//    public function setNumberOfComments($numberOfComments): void
//    {
//        $this->numberOfComments = $numberOfComments;
//    }

    /**
     * @return mixed
     */
    public function getThumbnailFile()
    {
        return $this->thumbnailFile;
    }

    /**
     * @param mixed $thumbnailFile
     * @throws \Exception
     */
    public function setThumbnailFile($thumbnailFile): void
    {
        $this->thumbnailFile = $thumbnailFile;
        if ($thumbnailFile) {
            $this->updatedAt = new \DateTime('NOW');
        }
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->title;
    }



}

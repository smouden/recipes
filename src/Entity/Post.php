<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content_post = null;

    #[ORM\ManyToOne(inversedBy: 'post')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $poster = null;

    #[ORM\ManyToOne(inversedBy: 'post')]
    private ?Topic $topic = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentPost(): ?string
    {
        return $this->content_post;
    }

    public function setContentPost(string $content_post): static
    {
        $this->content_post = $content_post;

        return $this;
    }

    public function getPoster(): ?User
    {
        return $this->poster;
    }

    public function setPoster(?User $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    public function setTopic(?Topic $topic): static
    {
        $this->topic = $topic;

        return $this;
    }
}

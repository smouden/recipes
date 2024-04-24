<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Topic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title_topic = null;

    #[ORM\Column(length: 255)]
    private ?string $description_topic = null;

    #[ORM\OneToMany(mappedBy: 'topic', targetEntity: Post::class)]
    private Collection $post;

    public function __construct()
    {
        $this->post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleTopic(): ?string
    {
        return $this->title_topic;
    }

    public function setTitleTopic(string $title_topic): static
    {
        $this->title_topic = $title_topic;

        return $this;
    }

    public function getDescriptionTopic(): ?string
    {
        return $this->description_topic;
    }

    public function setDescriptionTopic(string $description_topic): static
    {
        $this->description_topic = $description_topic;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPost(): Collection
    {
        return $this->post;
    }

    public function addPost(Post $post): static
    {
        if (!$this->post->contains($post)) {
            $this->post->add($post);
            $post->setTopic($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->post->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getTopic() === $this) {
                $post->setTopic(null);
            }
        }

        return $this;
    }
}
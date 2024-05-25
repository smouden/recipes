<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title_recipe = null;

    #[ORM\Column(length: 800)]
    private ?string $description_recipe = null;

    #[ORM\Column]
    private ?int $prep_time = null;

    #[ORM\Column]
    private ?int $cook_time = null;

    #[ORM\Column]
    private ?int $number_serving = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_recipe = null;

    #[ORM\ManyToOne(inversedBy: 'recipe')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator_recipe = null;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'recipes')]
    private Collection $ingredient;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(length: 800)]
    private ?string $procedure = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Like::class, orphanRemoval: true)]
    private Collection $likes;




    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->title_recipe;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleRecipe(): ?string
    {
        return $this->title_recipe;
    }

    public function setTitleRecipe(string $title_recipe): static
    {
        $this->title_recipe = $title_recipe;

        return $this;
    }

    public function getDescriptionRecipe(): ?string
    {
        return $this->description_recipe;
    }

    public function setDescriptionRecipe(string $description_recipe): static
    {
        $this->description_recipe = $description_recipe;

        return $this;
    }

    public function getPrepTime(): ?int
    {
        return $this->prep_time;
    }

    public function setPrepTime(int $prep_time): static
    {
        $this->prep_time = $prep_time;

        return $this;
    }

    public function getCookTime(): ?int
    {
        return $this->cook_time;
    }

    public function setCookTime(int $cook_time): static
    {
        $this->cook_time = $cook_time;

        return $this;
    }

    public function getNumberServing(): ?int
    {
        return $this->number_serving;
    }

    public function setNumberServing(int $number_serving): static
    {
        $this->number_serving = $number_serving;

        return $this;
    }

    public function getPictureRecipe(): ?string
    {
        return $this->picture_recipe;
    }

    public function setPictureRecipe(string $picture_recipe): static
    {
        $this->picture_recipe = $picture_recipe;

        return $this;
    }

    public function getCreatorRecipe(): ?User
    {
        return $this->creator_recipe;
    }

    public function setCreatorRecipe(?User $creator_recipe): static
    {
        $this->creator_recipe = $creator_recipe;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getProcedure(): ?string
    {
        return $this->procedure;
    }

    public function setProcedure(string $procedure): static
    {
        $this->procedure = $procedure;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setRecipe($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getRecipe() === $this) {
                $comment->setRecipe(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): static
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setRecipe($this);
        }

        return $this;
    }

    public function removeLike(Like $like): static
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getRecipe() === $this) {
                $like->setRecipe(null);
            }
        }

        return $this;
    }




}

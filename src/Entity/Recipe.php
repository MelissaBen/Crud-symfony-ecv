<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitle;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="recipe")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="recipe")
     */
    private $rates;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageRate;


    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $preparationTime;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $cookingTime;

    /**
     * @ORM\Column(type="array", nullable=true)
     */

    private $steps = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", cascade={"persist"})
     */
    private $ingredients;


    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->rates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setRecipe($this);
        }

        return $this;
    }

    public function getPreparationTime(): ?\DateTimeInterface
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(?\DateTimeInterface $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getRecipe() === $this) {
                $comment->setRecipe(null);
            }
        }
        return $this;
    }

    public function getCookingTime(): ?\DateTimeInterface
    {
        return $this->cookingTime;
    }

    public function setCookingTime(?\DateTimeInterface $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setRecipe($this);
        }
        return $this;
    }
    public function getSteps(): ?array
    {
        return $this->steps;
    }

    public function setSteps(?array $steps): self
    {
        $this->steps = $steps;

        return $this;
    }


    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getRecipe() === $this) {
                $rate->setRecipe(null);
            }
        }
        return $this;
    }
    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
        }

        return $this;
    }

    public function getAverageRate(): ?float
    {
        return $this->averageRate;
    }

    public function setAverageRate(?float $averageRate): self
    {
        $this->averageRate = $averageRate;

        return $this;
    }
    public function getIngredientsCollection()
    {
        $ingredientsCollection = new ArrayCollection();

        foreach ($this->getIngredients() as $ingredient) {
            $ingredientsCollection->add($ingredient);
        }
        return $ingredientsCollection;
    }
    public function __toString()
    {
        return $this->title;
    }
}

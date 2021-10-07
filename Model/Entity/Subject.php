<?php

namespace Forum\Entity;

class Subject {

    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $date;
    private ?string $text;
    private ?string $picture;
    private ?Categorie $categorie_fk;
    private ?User $user_fk;

    /**
     * @param int|null $id
     * @param string|null $title
     * @param string|null $description
     * @param string|null $date
     * @param string|null $text
     * @param string|null $picture
     * @param Categorie|null $categorie_fk
     * @param User|null $user_fk
     */
    public function __construct(?int $id = null, ?string $title = null, ?string $description = null, ?string $date = null,
                                ?string $text = null, ?string $picture = null, ?Categorie $categorie_fk = null, ?User $user_fk = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->text = $text;
        $this->picture = $picture;
        $this->categorie_fk = $categorie_fk;
        $this->user_fk = $user_fk;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): void {
        $this->text = $text;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture(?string $picture): void {
        $this->picture = $picture;
    }

    /**
     * @return Categorie|null
     */
    public function getCategorieFk(): ?Categorie {
        return $this->categorie_fk;
    }

    /**
     * @param Categorie|null $categorie_fk
     */
    public function setCategorieFk(?Categorie $categorie_fk): void {
        $this->categorie_fk = $categorie_fk;
    }

    /**
     * @return User|null
     */
    public function getUserFk(): ?User {
        return $this->user_fk;
    }

    /**
     * @param User|null $user_fk
     */
    public function setUserFk(?User $user_fk): void {
        $this->user_fk = $user_fk;
    }
}
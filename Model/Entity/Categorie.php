<?php

namespace Forum\Entity;

class Categorie {

    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $picture;
    private ?User $user_fk;

    /**
     * @param int|null $id
     * @param string|null $title
     * @param string|null $description
     * @param string|null $picture
     * @param User|null $user_fk
     */
    public function __construct(?int $id = null, ?string $title = null, ?string $description = null, ?string $picture = null,
                                ?User $user_fk = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->picture = $picture;
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
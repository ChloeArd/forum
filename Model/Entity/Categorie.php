<?php

namespace Chloe\Forum\Entity;

class Categorie {

    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $picture;
    private ?User $user_fk;
    private ?int $archive;

    /**
     * @param int|null $id
     * @param string|null $title
     * @param string|null $description
     * @param string|null $picture
     * @param User|null $user_fk
     */
    public function __construct(?int $id = null, ?string $title = null, ?string $description = null, ?string $picture = null,
                                ?User $user_fk = null, ?int $archive = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->picture = $picture;
        $this->user_fk = $user_fk;
        $this->archive = $archive;
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
    public function setId(?int $id): ?int {
        $this->id = $id;
        return $id;
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
    public function setTitle(?string $title): ?string {
        $this->title = $title;
        return $title;
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
    public function setDescription(?string $description): ?string {
        $this->description = $description;
        return $description;
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
    public function setPicture(?string $picture): ?string {
        $this->picture = $picture;
        return $picture;
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
    public function setUserFk(?User $user_fk): ?User {
        $this->user_fk = $user_fk;
        return $user_fk;
    }

    /**
     * @return int|null
     */
    public function getArchive(): ?int {
        return $this->archive;
    }

    /**
     * @param int|null $archive
     */
    public function setArchive(?int $archive): ?int {
        $this->archive = $archive;
        return $archive;
    }

}
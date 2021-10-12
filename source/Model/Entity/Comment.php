<?php

namespace Chloe\Forum\Entity;

class Comment {

    private ?int $id;
    private ?string $date;
    private ?string $comment;
    private ?Categorie $categorie_fk;
    private ?Subject $subject_fk;
    private ?User $user_fk;

    /**
     * @param int|null $id
     * @param string|null $date
     * @param string|null $comment
     * @param Categorie|null $categorie_fk
     * @param Subject|null $subject_fk
     * @param User|null $user_fk
     */
    public function __construct(?int $id = null, ?string $date = null, ?string $comment = null, ?Categorie $categorie_fk = null, ?Subject $subject_fk = null,
                                ?User $user_fk = null) {
        $this->id = $id;
        $this->date = $date;
        $this->comment = $comment;
        $this->categorie_fk = $categorie_fk;
        $this->subject_fk = $subject_fk;
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
    public function setId(?int $id): ?int {
        $this->id = $id;
        return $id;
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
    public function setDate(?string $date): ?string {
        $this->date = $date;
        return $date;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     */
    public function setComment(?string $comment): ?string {
        $this->comment = $comment;
        return $comment;
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
    public function setCategorieFk(?Categorie $categorie_fk): ?Categorie {
        $this->categorie_fk = $categorie_fk;
        return $categorie_fk;
    }

    /**
     * @return Subject|null
     */
    public function getSubjectFk(): ?Subject {
        return $this->subject_fk;
    }

    /**
     * @param Subject|null $subject_fk
     */
    public function setSubjectFk(?Subject $subject_fk): ?Subject {
        $this->subject_fk = $subject_fk;
        return $subject_fk;
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
}
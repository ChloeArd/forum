<?php

namespace Forum\Entity;

class Comment {

    private ?int $id;
    private ?string $date;
    private ?string $comment;
    private ?Subject $subject_fk;
    private ?User $user_fk;

    /**
     * @param int|null $id
     * @param string|null $date
     * @param string|null $comment
     * @param Subject|null $subject_fk
     * @param User|null $user_fk
     */
    public function __construct(?int $id = null, ?string $date = null, ?string $comment, ?Subject $subject_fk = null,
                                ?User $user_fk = null) {
        $this->id = $id;
        $this->date = $date;
        $this->comment = $comment;
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
    public function setId(?int $id): void {
        $this->id = $id;
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
    public function getComment(): ?string {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     */
    public function setComment(?string $comment): void {
        $this->comment = $comment;
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
    public function setSubjectFk(?Subject $subject_fk): void {
        $this->subject_fk = $subject_fk;
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
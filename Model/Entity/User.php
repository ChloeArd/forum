<?php

namespace Forum\Entity;

class User {

    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;
    private ?Role $role_fk;

    /**
     * @param int|null $id
     * @param string|null $pseudo
     * @param string|null $email
     * @param string|null $password
     * @param Role|null $role_fk
     */
    public function __construct(?int $id = null, ?string $pseudo = null, ?string $email = null, ?string $password = null,
                                ?Role $role_fk = null) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->role_fk = $role_fk;
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
    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    /**
     * @param string|null $pseudo
     */
    public function setPseudo(?string $pseudo): ?string {
        $this->pseudo = $pseudo;
        return $pseudo;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): ?string {
        $this->email = $email;
        return $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): ?string {
        $this->password = $password;
        return $password;
    }

    /**
     * @return Role|null
     */
    public function getRoleFk(): ?Role {
        return $this->role_fk;
    }

    /**
     * @param Role|null $role_fk
     */
    public function setRoleFk(?Role $role_fk): ?Role {
        $this->role_fk = $role_fk;
        return $role_fk;
    }
}
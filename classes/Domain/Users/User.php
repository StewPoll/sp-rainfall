<?php


namespace Rainfall\Domain\Users;


use Ramsey\Uuid\Uuid;

class User
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $displayName;

    /**
     * @var string Password Hash
     */
    private string $password;

    /**
     * User constructor.
     * @param string $id
     * @param string $username
     * @param string $displayName
     * @param string $password
     */
    private function __construct(string $id, string $username, string $displayName, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->displayName = $displayName;
        $this->password = $password;
    }

    /**
     * @param string $id
     * @param string $username
     * @param string $displayName
     * @param string $passwordHash
     * @return $this
     */
    public static function restore(string $id, string $username, string $displayName, string $passwordHash): User
    {
        return new static($id, $username, $displayName, $passwordHash);
    }

    /**
     * @param string $username
     * @param string $displayName
     * @param string $password
     * @return $this
     */
    public static function createWith(string $username, string $displayName, string $password): User
    {
        $id = Uuid::uuid4()->toString();
        $passwordHash = self::hashPassword($password);
        return new static($id, $username, $displayName, $passwordHash);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Verifies password for logging in
     *
     * @param $password
     * @return bool
     */
    public function verifyPassword($password): bool
    {
        return password_verify($password, $this->password);
    }

    /**
     * Hashes Password using ARGON2
     *
     * @param $password
     * @return string
     */
    private function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = self::hashPassword($password);
    }
}
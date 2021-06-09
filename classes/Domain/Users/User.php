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
    private string $passwordHash;

    /**
     * User constructor.
     * @param string $id
     * @param string $username
     * @param string $passwordHash
     */
    private function __construct(string $id, string $username, string $passwordHash)
    {
        $this->id = $id;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @param string $id
     * @param string $username
     * @param string $passwordHash
     * @return $this
     */
    public function restore(string $id, string $username, string $passwordHash): User
    {
        return new static($id, $username, $passwordHash);
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function createWith(string $username, string $password): User
    {
        $id = Uuid::uuid4()->toString();
        $passwordHash = self::hashPassword($password);
        return new static($id, $username, $passwordHash);
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
        return password_verify($password, $this->passwordHash);
    }

    /**
     * Hashes Password using ARGON2
     *
     * @param $password
     * @return false|string|null
     */
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
}
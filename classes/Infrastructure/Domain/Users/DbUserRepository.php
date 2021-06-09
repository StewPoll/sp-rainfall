<?php


namespace Rainfall\Infrastructure\Domain\Users;


use PicoDb\Database;
use Rainfall\Domain\Users\User;
use Rainfall\Domain\Users\UserRepository;

class DbUserRepository implements UserRepository
{
    const TABLE = 'spr_users';

    private Database $db;

    /**
     * DbUserRepository constructor.
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * @param array $userData
     * @return User
     */
    private function deserealize(array $user): User
    {
        return User::restore(
            $user['id'],
            $user['username'],
            $user['display_name'],
            $user['password']
        );
    }

    /**
     * @param User $user
     * @return array
     */
    private function serealize(User $user): array
    {
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'display_name' => $user->getDisplayName(),
            'password' => $user->getPassword()
        ];
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $userData = $this->db
            ->table(self::TABLE)
            ->findAll();

        $users = [];
        foreach ($userData as $user) {
            $users[] = $this->deserealize($user);
        }

        return $users;
    }

    /**
     * @inheritDoc
     */
    public function findById(string $id): ?User
    {
        $user = $this->db
            ->table(self::TABLE)
            ->eq('id', $id)
            ->findOne();

        if (!$user) {
            return null;
        }

        return $this->deserealize($user);
    }

    /**
     * @inheritDoc
     */
    public function add(User $user)
    {
        $original = $this->findById($user->getId());
        $user = $this->serealize($user);

        if ($original) {
            $this->db
                ->table(self::TABLE)
                ->eq('id', $user['id'])
                ->update($user);
        } else {
            $this->db
                ->table(self::TABLE)
                ->insert($user);
        }
    }

    /**
     * @inheritDoc
     */
    public function remove(User $user)
    {
        $original = $this->findById($user->getId());

        if ($original) {
            $this->db
                ->table(self::TABLE)
                ->eq('id', $user->getId())
                ->remove();
        }
    }
}
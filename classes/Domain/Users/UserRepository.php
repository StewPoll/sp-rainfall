<?php


namespace Rainfall\Domain\Users;


interface UserRepository
{
    /**
     * Finds all users
     *
     * @return User[]
     */
    public function findAll(): array;

    /**
     * Finds a user by their ID
     *
     * @param string $id
     * @return User|null
     */
    public function findById(string $id): ?User;

    /**
     * Adds a user
     *
     * @param User $user
     */
    public function add(User $user);

    /**
     * Removes a user
     *
     * @param User $user
     */
    public function remove(User $user);
}
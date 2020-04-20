<?php


namespace App\Model\User\Entity\User;


interface UserRepository
{
    public function findByConfirmToken(string $token): ?User;

    public function hasByEmail(Email $email): bool;

    public function add(User $user): void;

    public function hasByNetworkIdentity(string $network, string $identity): bool;

    public function getByEmail(Email $param): User;

    public function findByResetToken(string $token): ?User;

    public function get(Id $id): User;
}
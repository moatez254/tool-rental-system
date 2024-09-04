<?php

declare(strict_types=1);
namespace App\UI\Home;

use Nette\Database\Explorer;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;
use Nette\Security\Authenticator;
use Nette\Security\AuthenticationException;
use Nette\Security\IIdentity;

class UserManager implements Authenticator
{
    private $database;
    private $passwords;

    public function __construct(Explorer $database, Passwords $passwords)
    {
        $this->database = $database;
        $this->passwords = $passwords;
    }

    public function authenticate(string $username, string $password): IIdentity
    {
        // Fetch user from the database by username
        $user = $this->database->table('users')
            ->where('username', $username)
            ->fetch();

        // If the user doesn't exist, throw an exception
        if (!$user) {
            throw new AuthenticationException('User not found.');
        }

        // Verify the password
        if (!$this->passwords->verify($password, $user->password)) {
            throw new AuthenticationException('Invalid password.');
        }

        // Return an identity object (can include roles and other data)
        return new SimpleIdentity($user->id, $user->role, ['username' => $user->username]);
    }
}

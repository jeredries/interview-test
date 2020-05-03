<?php
/**
 * Created by PhpStorm.
 * User: jdries
 * Date: 02/05/2020
 * Time: 15:08
 */

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider
 */
class UserProvider implements UserProviderInterface
{
    /**
     * Refreshes the user after being reloaded from the session.
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     *
     * @param  UserInterface $user
     *
     * @return User|UserInterface
     * @throws \Exception
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        return $user;
    }

    /**
     * Tells Symfony to use this provider for this User class.
     *
     * @param $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }

    /**
     * Loads the user for the given username.
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param  string $username The username
     *
     * @return UserInterface
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        return null;
    }

    /**
     * Load user
     *
     * @return User
     */
    public function loadUser()
    {
        return new User();
    }
}


<?php
/**
 * Created by PhpStorm.
 * User: jdries
 * Date: 02/05/2020
 * Time: 11:53
 */

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class TokenAuthenticator
 */
class TokenAuthenticator extends AbstractGuardAuthenticator
{
    private const TOKEN_TEST = 'fqFFdffggfdhfdDF859FG';
    private const LOGIN_ROUTE = 'app_login';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * TokenAuthenticator constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning false will cause this authenticator
     * to be skipped.
     *
     * @param Request $request
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function supports(Request $request): bool
    {
        return true;
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     *
     * @param Request $request
     *
     * @return array
     */
    public function getCredentials(Request $request): array
    {
        if (self::LOGIN_ROUTE === $request->attributes->get('_route')) {
            $data = json_decode($request->getContent(), true);
            $credentials = [
                'email' => isset($data) && isset($data['email']) ? $data['email'] : '',
                'password' => isset($data) && isset($data['password']) ? $data['password'] : '',
            ];
            $request->getSession()->set(
                Security::LAST_USERNAME,
                $credentials['email']
            );

            return $credentials;
        }
        $credentials['token'] = $request->headers->has('X-AUTH-TOKEN') ?
            $request->headers->get('X-AUTH-TOKEN') : null;

        return $credentials;
    }

    /**
     * @param array                 $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider): UserInterface
    {
        // is test authentication
        // need to get in bdd
        $user = new User();
        $user->setUsername('bjulia@easyblue.io');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->setToken(self::TOKEN_TEST);

        return $user;
    }

    /**
     * @param mixed              $credentials
     * @param UserInterface|User $user
     *
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user): bool
    {
        if (isset($credentials['email']) && isset($credentials['password'])) {

            return $user->getUsername() === $credentials['email'] &&
                $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        }

        return $user->getToken() === $credentials['token'];
    }

    /**
     * @param Request        $request
     * @param TokenInterface $token
     * @param string         $providerKey
     *
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): ?Response
    {
        return null;
    }

    /**
     * @param Request                 $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Called when authentication is needed, but it's not sent
     *
     * @param Request                      $request
     * @param AuthenticationException|null $authException
     *
     * @return JsonResponse
     */
    public function start(Request $request, AuthenticationException $authException = null): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED);
    }

    /**
     * @return bool
     */
    public function supportsRememberMe(): bool
    {
        return false;
    }
}
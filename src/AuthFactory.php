<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @package Aura.Auth
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Auth;

use Aura\Auth\Session;
use Aura\Auth\Verifier;
use Aura\Auth\Adapter;
use PDO;

/**
 *
 * Auth Factory
 *
 * @package Aura.Auth
 *
 */

class AuthFactory
{
    /**
     *
     * Returns a new Auth object.
     *
     * @param array $cookie A copy of $_COOKIE.
     *
     * @param int $idle_ttl
     *
     * @param int $expire_ttl
     *
     * @return Auth
     *
     */
    public function newAuth()
    {
        return new Auth(new Session\Segment);
        return $user;
    }

    /**
     *
     * Returns a new PDO adapter.
     *
     * @param PDO $pdo
     *
     * @param string|object $verifier_spec
     *
     * @param array $cols
     *
     * @param string $from
     *
     * @param string $where
     *
     * @return Adapter\PdoAdapter
     *
     */
    public function newPdoAdapter(
        PDO $pdo,
        $verifier_spec,
        array $cols,
        $from,
        $where = null
    ) {
        if (is_string($verifier_spec)) {
            $verifier = new Verifier\HashVerifier($verifier_spec);
        } elseif (is_int($verifier_spec)) {
            $verifier = new Verifier\PasswordVerifier($verifier_spec);
        } else {
            $verifier = $verifier_spec;
        }

        return new Adapter\PdoAdapter(
            $pdo,
            $verifier,
            $cols,
            $from,
            $where
        );
    }

    /**
     *
     * Returns a new Htpasswd adapter.
     *
     * @param string $file
     *
     * @return Adapter\HtpasswdAdapter
     *
     */
    public function newHtpasswdAdapter($file)
    {
        $verifier = new Verifier\HtpasswdVerifier;
        return new Adapter\HtpasswdAdapter(
            $file,
            $verifier
        );
    }
}

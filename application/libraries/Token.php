<?php
use Symfony\Component\Security\Csrf\CsrfToken;

class Token
{
    public function csrf()
    {
        $options = array(
            'name' => 'example', //namacsrf
            'cache_limiter' => '',
            'cache_expire' => 0,
            'use_cookies' => 1,
            'lazy_write' => 1,
            'use_strict_mode' => 1,
            'use_only_cookies' => 1,
            'cookie_httponly' => 1,
        );
        $nativesession = new Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage($options);
        $session = new Symfony\Component\HttpFoundation\Session\Session($nativesession);
        $tokenstorage = new Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage($session);
        return new Symfony\Component\Security\Csrf\CsrfTokenManager();
    }
    
    public function verifiedCSRF($key_id, $token) {
        $tokenkey = strval(crc32('[INSERT-SALTING'.$key_id.']'));
        $csrf = new CsrfToken($key_id, $token);
        if ($this->csrf()->isTokenValid($csrf)) {
            $this->csrf()->removeToken($tokenkey);
            return true;
        } else {
            $this->csrf()->removeToken($tokenkey);
            return false;
        }
    }

    public function generateCsrfToken($key_id) 
    {
        $tokenkey = strval(crc32('[INSERT-SALTING'.$key_id.']'));
        return $this->csrf()->getToken($tokenkey);
    }
}
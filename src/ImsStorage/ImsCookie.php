<?php

namespace Packback\Lti1p3\ImsStorage;

use Packback\Lti1p3\Interfaces\ICookie;

class ImsCookie implements ICookie
{
    public function getCookie($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        // Look for backup cookie if same site is not supported by the user's browser.
        if (isset($_COOKIE['LEGACY_'.$name])) {
            return $_COOKIE['LEGACY_'.$name];
        }

        return false;
    }

    public function setCookie($name, $value, $exp = 3600, $options = [])
    {
        $cookieOptions = [
            'expires' => time() + $exp,
        ];

        // SameSite none and secure will be required for tools to work inside iframes
        $sameSiteOptions = [
            'samesite' => 'None',
            'secure' => true,
        ];

        setcookie($name, $value, array_merge($cookieOptions, $sameSiteOptions, $options));

        // Set a second fallback cookie in the event that "SameSite" is not supported
        setcookie('LEGACY_'.$name, $value, array_merge($cookieOptions, $options));

        return $this;
    }
}

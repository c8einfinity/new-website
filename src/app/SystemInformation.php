<?php

class SystemInformation
{
    public static function getGoogleSiteKey()
    {
        return $_ENV["GOOGLE_CAPTCHA_SITE_KEY"];
    }
}
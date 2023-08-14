<?php

/**
 * Copyright © 2023 - Code Infinity. All right reserved.
 *
 * @author Justin Bruce <justin@codeinfinity.co.za>
 */
class Captcha
{
    /**
     * Google reCaptcha check
     * @param string $token
     * @param string $action
     * @return bool|void
     */
    public static function checkCaptcha(string $token, string $action)
    {
        if (!$token) {
            echo '<h2>Please check the captcha form or refresh the page.</h2>';
            die();
        }

        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => $_ENV["GOOGLE_CAPTCHA_SECRET_KEY"], 'response' => $token, 'remoteip' => $_SERVER['REMOTE_ADDR']);
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        $captchaResponse = file_get_contents($url, false, $context);
        $responseKeys = json_decode($captchaResponse, true);

        if ($responseKeys["success"] && $responseKeys["action"] == $action && $responseKeys["score"] >= 0.5 || $_ENV["TINA4_DEBUG"]) {
            return true;
        }

        return false;
    }
}
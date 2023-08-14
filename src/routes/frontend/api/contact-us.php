<?php

use function Tina4\renderTemplate;

\Tina4\Post::add("/api/frontend/contact-us", function (\Tina4\Response $response, \Tina4\Request $request) {
    $requestParams = $request->params;

    if (!Captcha::checkCaptcha($requestParams["captchaToken"], $requestParams["captchaAction"])) {
        return $response ("<script>alert('Are you a bot?')</script>", HTTP_OK, TEXT_HTML);
    }

    $emailHelper = (new Email());
    $userName = $requestParams["userName"];
    $userEmail = $requestParams["userEmail"];
    $userTel = $requestParams["userTel"];
    $userCompany = $requestParams["userCompany"];
    $userMessage = $requestParams["userMessage"];

    // Check if email does send
    if (!$emailHelper->sendContactEmail($userName, $userEmail, $userTel, $userCompany, $userMessage, 1, $_ENV["RECEIVING_EMAIL"])) {
        // Email didn't send
        // Display error message
        return $response (["message" => "<h3>Email could not be sent. Please try again.</h3>"], HTTP_OK, TEXT_HTML);
    }

    // Notify user about failed email attempt to their email address
    if (!$emailHelper->sendContactEmail($userName, $userEmail, $userTel, $userCompany, $userMessage, 0, $userEmail)) {
        return $response (["message" => "<h3>An email could not be sent to your email address due to a problem, but your contact information has been received on our side. Please be patient.</h3>"], HTTP_OK, TEXT_HTML);
    }

    // Email sent
    return $response (["message" => "<h3>Email has been sent. We will get back to you are soon as we can. Enjoy the rest of your day.</h3>"], HTTP_OK, TEXT_HTML);
});
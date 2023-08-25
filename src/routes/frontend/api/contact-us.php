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
        return $response (["message" => "<p style='color: var(--color-blue);font-size: 20px;background: #16b2cf1c;border: 1px solid var(--color-blue);line-height: 1;padding: 10px 13px 12px;border-radius: 3px;width: max-content;'>Oops! There was an error sending your email, but your contact information has been received on our side. Thank you for your patience</p>"], HTTP_OK, TEXT_HTML);
    }

    // Email sent
    return $response (["message" => "<p style='color: var(--color-blue);font-size: 20px;background: #16b2cf1c;border: 1px solid var(--color-blue);line-height: 1;padding: 10px 13px 12px;border-radius: 3px;width: max-content;'>Email sent successfully! We'll be in touch soon.</p>"], HTTP_OK, TEXT_HTML);
});



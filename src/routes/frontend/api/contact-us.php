<?php

\Tina4\Post::add("/api/frontend/contact-us", function (\Tina4\Response $response, \Tina4\Request $request) {
    $requestParams = $request->params;
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
        return $response ("Email could not be send. Please try again", HTTP_OK, TEXT_HTML);
    }

    $emailHelper->sendContactEmail($userName, $userEmail, $userTel, $userCompany, $userMessage, 0, $userEmail);

    // Email sent
    return $response ("Email has been sent. You will get feedback ASAP.", HTTP_OK, TEXT_HTML);
});
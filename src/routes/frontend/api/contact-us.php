<?php

\Tina4\Post::add("/api/frontend/contact-us", function (\Tina4\Response $response, \Tina4\Request $request) {
    $requestParams = $request->params;

    // Check if email does send
    if (!(new Email())->sendContactEmail($requestParams["userName"], $requestParams["userEmail"], $requestParams["userTel"], $requestParams["userCompany"], $requestParams["userMessage"])) {
        // Email didn't send
        // Display error message
        return $response ("Email could not be send. Please try again", HTTP_OK, TEXT_HTML);
    }

    // Email sent
    return $response ("Email has been sent. You will get feedback ASAP.", HTTP_OK, TEXT_HTML);
});
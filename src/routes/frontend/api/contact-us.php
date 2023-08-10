<?php

\Tina4\Post::add("/api/contact-us", function (\Tina4\Response $response, \Tina4\Request $request) {
    $requestParams = $request->params;

    // Check if email does send
    if (!(new Email())->sendContactEmail($requestParams["email"], $requestParams["fullname"])) {
        // Email didn't send
        // Display error message
    }
});
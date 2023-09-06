<?php

\Tina4\Get::add("signature/creator", function (\Tina4\Response $response) {

    return $response (\Tina4\renderTemplate("signature-creator.twig"), HTTP_OK, TEXT_HTML);
});

\Tina4\Post::add("signature/creator", function (\Tina4\Response $response, \Tina4\Request $request) {

    $signature =
    _div(["style" => "background: pink"],
        _img(["src" => "https://codeinfinity.co.za/images/logo.png", "style" => "width: 100px; height: 100px;"]),
        "This is a test {$request->params["name"]}",
        _div(["style" =>  "background:  green"],"Title :".$request->params["title"]),
        _div(["style" =>  "background:  blue"],"Telephone :".$request->params["mobile"]),
        _div(["style" =>  "background:  blue"],"Email :".$request->params["email"]),
        html_entity_decode($request->params["additional_html"])
    );


    return $response (\Tina4\renderTemplate("signature-creator.twig", ["signature" => $signature]), HTTP_OK, TEXT_HTML);
});
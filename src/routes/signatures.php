<?php

\Tina4\Get::add("signature/creator", function (\Tina4\Response $response) {

    return $response (\Tina4\renderTemplate("signature-creator.twig"), HTTP_OK, TEXT_HTML);
});

\Tina4\Post::add("signature/creator", function (\Tina4\Response $response, \Tina4\Request $request) {
    $additionalHtml = html_entity_decode($request->params["additional_html"]);
    $additionalHtmlVisible = !empty($additionalHtml);

    $signature = _table(["width" => "690", "cellpadding" => "0", "cellspacing" => "0", "style" => "background: #FFFFFF; width: 690px;"],
        _tr(
            _td(
                _table(["width" => "100%", "cellpadding" => "0", "cellspacing" => "0"],
                    _tr(
                        _p(["style" => "font-family: Arial, sans-serif; font-size: 22px; margin: 0; color: #1ba6c5;"],
                            _strong($request->params["name"])
                        ),
                        _p(["style" => "font-family: Arial, sans-serif; font-size: 16px; margin: 0; color: #000000; margin-top: 6px; margin-bottom: 15px;"],
                            _strong($request->params["title"])
                        )
                    )
                )
            )
        ),
        _tr(
            _td(
                _table(["width" => "30", "cellpadding" => "0", "cellspacing" => "0", "style" => "padding-bottom: 5px;"],
                    _tr(
                        _td(
                            _img(["src" => "https://codeinfinity.co.za/images/c8-signature-email.png", "alt" => "Email Icon", "style" => "width: 26px;"])
                        ),
                        _td(["style" => "padding-left: 15px;"],
                            _p(["style" => "font-family: Arial, sans-serif; font-size: 14px; margin: 0;"],
                                _a(["style" => "text-decoration: none !important; color: #000000", "href" => "mailto:" . $request->params["email"]], $request->params["email"])
                            )
                        )
                    )
                )
            )
        ),
        _tr(
            _td(
                _table(["width" => "30", "cellpadding" => "0", "cellspacing" => "0"],
                    _tr(
                        _td(
                            _img(["src" => "https://codeinfinity.co.za/images/c8-signature-phone.png", "alt" => "Phone Icon", "style" => "width: 26px;"])
                        ),
                        _td(["style" => "padding-left: 15px;"],
                            _p(["style" => "font-family: Arial, sans-serif; font-size: 14px; margin: 0;"],
                                _a(["style" => "text-decoration: none !important; color: #000000", "href" => "tel:" . $request->params["mobile"]], $request->params["mobile"])
                            )
                        )
                    )
                )
            )
        ),
        _tr(
            _td(
                _table(["width" => "30", "cellpadding" => "0", "cellspacing" => "0"],
                    _tr(
                        _td(
                            _img(["src" => "https://codeinfinity.co.za/images/c8-email-signature-banner.png", "style" => "width: 690px;"])
                        )
                    )
                )
            )
        ),
        _tr(
            _td(["style" => "font-family: Arial, sans-serif; font-size: 12px; color: #707070; padding-top: 10px; padding-bottom: 18px;"],
                "The content of this email is confidential and intended for the recipient specified in the message only. It is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. If you received this message by mistake, please reply to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future."
            )
        )
    );

    $signature = _div(["style" => "background: #FFFFFF"], $signature,
        _table(["width" => "690", "cellpadding" => "0", "cellspacing" => "0"],
            _tr(
                _td(["style" => ($additionalHtmlVisible ? "border-top: 1px solid #d4d4d4; padding-top: 10px;" : "")],
                    $additionalHtml
                )
            )
        )
    );

    return $response (\Tina4\renderTemplate("signature-creator.twig", ["signature" => $signature]), HTTP_OK, TEXT_HTML);
});

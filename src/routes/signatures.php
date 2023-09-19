<?php

\Tina4\Get::add("signature/creator", function (\Tina4\Response $response) {

    return $response (\Tina4\renderTemplate("signature-creator.twig"), HTTP_OK, TEXT_HTML);
});

\Tina4\Post::add("signature/creator", function (\Tina4\Response $response, \Tina4\Request $request) {
    $additionalHtml = html_entity_decode($request->params["additional_html"]);
    $additionalHtmlVisible = !empty($additionalHtml) ? "border-top: 1px solid #d4d4d4; padding-top: 8px;" : "";

    $signature = _table(["width" => "690", "cellpadding" => "0", "cellspacing" => "0", "style" => "background: #FFFFFF; width: 648px;"],
        _tr(
            _td(["style" => "width: 40%;"],
                _table(["width" => "22", "cellpadding" => "0", "cellspacing" => "0"],
                    _tr(
                        _td(
                            _img(["src" => "https://codeinfinity.co.za/images/c8-signature-email.png", "alt" => "Email Icon", "style" => "width: 22px;"])
                        ),
                        _td(["style" => "padding-left: 10px;"],
                            _p(["style" => "font-family: Arial, sans-serif; font-size: 14px; margin: 0;"],
                                _a(["style" => "text-decoration: none !important; color: #000000; white-space: nowrap;", "href" => "mailto:" . $request->params["email"]], $request->params["email"])
                            )
                        )
                    )
                ),
                _table(["width" => "22", "cellpadding" => "0", "cellspacing" => "0"],
                    _tr(
                        _td(
                            _img(["src" => "https://codeinfinity.co.za/images/c8-signature-phone.png", "alt" => "Phone Icon", "style" => "width: 22px;"])
                        ),
                        _td(["style" => "padding-left: 10px;"],
                            _p(["style" => "font-family: Arial, sans-serif; font-size: 14px; margin: 0;"],
                                _a(["style" => "text-decoration: none !important; color: #000000; white-space: nowrap;", "href" => "tel:" . $request->params["mobile"]], $request->params["mobile"])
                            )
                        )
                    )
                ),
                _table(["width" => "22", "cellpadding" => "0", "cellspacing" => "0"],
                    _tr(
                        _td(
                            _img(["src" => "https://codeinfinity.co.za/images/c8-signature-web.png", "alt" => "Web Icon", "style" => "width: 22px;"])
                        ),
                        _td(["style" => "padding-left: 10px;"],
                            _p(["style" => "font-family: Arial, sans-serif; font-size: 14px; margin: 0;"],
                                _a(["style" => "text-decoration: none !important; color: #000000; white-space: nowrap;", "href" => "https://codeinfinity.co.za/"], "www.codeinfinity.co.za")
                            )
                        )
                    )
                )
            ),
            _td(["style" => "width: 60%; vertical-align: top; padding-right: 10px;"],
                _table(["width" => "100%", "cellpadding" => "0", "cellspacing" => "0"],
                    _tr(
                        _p(["style" => "font-family: Arial, sans-serif; font-size: 20px; margin: 0; color: #1ba6c5; text-align: right;"],
                            _strong($request->params["name"])
                        ),
                        _p(["style" => "font-family: Arial, sans-serif; font-size: 15px; margin: 0; color: #000000; margin-top: 6px; margin-bottom: 15px; text-align: right;"],
                            _strong($request->params["title"])
                        )
                    )
                )
            )
        ),
        _tr(
            _td(["colspan" => "2", "style" => "padding-bottom: 8px;"],
                _img(["src" => "https://codeinfinity.co.za/images/c8-email-signature-bar.png", "style" => "width: 648px; margin: 0; padding: 0;"]),
                _p(["style" => "font-family: Arial, sans-serif; font-size: 10px; color: #9B9B9B; margin: 0 !important; line-height: 1.6;"],
                    "The content of this email is confidential and intended for the recipient specified in the message only. It is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. If you received this message by mistake, please reply to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future."
                )
            )
        ),
        _tr(
            _td(["colspan" => "2", "style" => "{$additionalHtmlVisible}"],
                $additionalHtml
            )
        )
    );

    return $response(\Tina4\renderTemplate("signature-creator.twig", ["signature" => $signature]), HTTP_OK, TEXT_HTML);
});

<?php

class Email
{
    /**
     * @param array $recipients // $recipients is the users details like their email
     * @param string $subject // e.g.Account Block, Account creation
     * @param string $templateName // The email template
     * @param array $data // The data you want to send through like their email, links, etc.
     * @return bool
     */
    private function sendingEmail(array $recipients, string $subject, string $templateName, array $data = []): bool
    {
        $settings = new \Tina4\MessengerSettings(true);
        $settings->smtpUsername = $_ENV["SMTP_USERNAME"];
        $settings->smtpPassword = $_ENV["SMTP_PASSWORD"];
        $settings->smtpServer = $_ENV["SMTP_SERVER"];
        $settings->smtpPort = $_ENV["SMTP_PORT"];

        return (new \Tina4\Messenger($settings))->sendEmail(
            $recipients,
            $subject,
            ["template" => $templateName, "data" => $data],
            "Code Infinity",
            // Your email to send from / You are sending the email from this account
            $_ENV["SEND_FROM_EMAIL"]
        );
    }

    /**
     * @param string $userName
     * @param string $userEmail
     * @param string $userTel
     * @param string $userCompany
     * @param string $userMessage
     * @return bool
     */
    public function sendContactEmail(string $userName, string $userEmail, string $userTel, string $userCompany, string $userMessage, int $isAdmin, string $receivingEmail): bool
    {
        $recipients[] = ["name" => "Code Infinity", "email" => $receivingEmail];

        return $this->sendingEmail($recipients, "Code Infinity Contact Us", "frontend/email/contact-us.twig",
            [
                "admin" => $isAdmin,
                "userName" => $userName,
                "userEmail" => $userEmail,
                "userTel" => $userTel,
                "userCompany" => $userCompany,
                "userMessage" => $userMessage
            ]);
    }
}
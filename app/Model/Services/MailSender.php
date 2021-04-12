<?php declare(strict_types=1);


namespace App\Model\Services;


use Latte\Engine;
use Nette\Application\LinkGenerator;
use Nette\Bridges\ApplicationLatte\LatteFactory;
use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

/**
 * Class MailSender
 * @package App\Model\Services
 */
class MailSender
{
    /**
     * MailSender constructor.
     * @param array $smtpConfig
     * @param LinkGenerator $linkGenerator
     * @param LatteFactory $templateFactory
     */
    public function __construct(
        private array $smtpConfig,
        private LinkGenerator $linkGenerator,
        private LatteFactory $templateFactory,
    )
    {
    }

    /**
     * Sent email SMTP
     * @param Message $message
     */
    public function sendSmtp(Message $message): void
    {
        $mailer = new SmtpMailer($this->smtpConfig);
        $mailer->send($message);
    }

    /**
     * Create email from latte file
     * @param string $latteFile
     * @param array $params
     * @return Message
     */
    public function createLatteEmail(string $latteFile, array $params): Message
    {
        $template = $this->createTemplate();
        $html = $template->renderToString($latteFile, $params);
        $mail = new Message();
        $mail->setHtmlBody($html);

        return $mail;
    }

    /**
     * @return Engine
     */
    private function createTemplate(): Engine
    {
        $template = $this->templateFactory->create();
        $template->addProvider('uiControl', $this->linkGenerator);
        return $template;
    }
}
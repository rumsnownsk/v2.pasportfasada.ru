<?php

namespace app\core\libs;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mail
{

    public $mailSet;
    public $message;
    public $mailer;

    public $subject;
    public $from;
    public $to;
    public $body;

    public function __construct($data)
    {
        $this->iniSetMail();

        $this->subject = $data['subject'];
        $this->from = isset($data['from']) ?: $this->mailSet['login'];
        $this->to = $data['to'];
        $this->body = $data['body'];

        $transport = (new Swift_SmtpTransport($this->mailSet['mailServer'], $this->mailSet['port']))
            ->setUsername($this->mailSet['login'])
            ->setPassword($this->mailSet['pass'])
            ->setEncryption($this->mailSet['encryption']);

        $this->mailer = new Swift_Mailer($transport);
    }

    public function run()
    {
        $message = (new Swift_Message($this->subject))
            ->setFrom([$this->from => 'Паспорт фасада'])
            ->setTo([$this->to])
            ->setBody($this->createdBodyMail());

        $this->mailer->send($message);
    }

    public function iniSetMail()
    {
        $fileConf = require ROOT . "/config/common.php";
        $this->mailSet = $fileConf['mail'];
    }

    protected function createdBodyMail()
    {
        return '<h3>Отзыв с сайта</h3>
                            <p><b>Имя:</b> '.$this->from.'</p>
                            <p><b>Тема:</b> '.$this->subject.'</p>
                            <p><b>Текст:</b></p>
                            <p>'.$this->body.'</p>';
    }

}
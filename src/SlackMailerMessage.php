<?php

namespace alexeevdv\slack\mailer;

use yii\mail\BaseMessage;

/**
 * Class SlackMailerMessage
 * @package alexeevdv\slack\mailer
 */
class SlackMailerMessage extends BaseMessage
{
    /**
     * @var string
     */
    private $_charset;

    /**
     * @var string|array
     */
    private $_from;

    /**
     * @var string|array
     */
    private $_to;

    /**
     * @var string|array
     */
    private $_replyTo;

    /**
     * @var string|array
     */
    private $_cc;

    /**
     * @var string|array
     */
    private $_bcc;

    /**
     * @var string
     */
    private $_subject;

    /**
     * @var string
     */
    private $_textBody;

    /**
     * @var string
     */
    private $_htmlBody;

    /**
     * @inheritdoc
     */
    public function getCharset()
    {
        return $this->_charset;
    }

    /**
     * @inheritdoc
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFrom()
    {
        return $this->_from;
    }

    /**
     * @inheritdoc
     */
    public function setFrom($from)
    {
        $this->_from = $from;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTo()
    {
        return $this->_to;
    }

    /**
     * @inheritdoc
     */
    public function setTo($to)
    {
        $this->_to = $to;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReplyTo()
    {
        return $this->_replyTo;
    }

    /**
     * @inheritdoc
     */
    public function setReplyTo($replyTo)
    {
        $this->_replyTo = $replyTo;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCc()
    {
        return $this->_cc;
    }

    /**
     * @inheritdoc
     */
    public function setCc($cc)
    {
        $this->_cc = $cc;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBcc()
    {
        return $this->_bcc;
    }

    /**
     * @inheritdoc
     */
    public function setBcc($bcc)
    {
        $this->_bcc = $bcc;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @inheritdoc
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTextBody($text)
    {
        $this->_textBody = $text;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setHtmlBody($html)
    {
        $this->_htmlBody = $html;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attach($fileName, array $options = [])
    {
        // TODO: Implement attach() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attachContent($content, array $options = [])
    {
        // TODO: Implement attachContent() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function embed($fileName, array $options = [])
    {
        // TODO: Implement embed() method.
        return uniqid();
    }

    /**
     * @inheritdoc
     */
    public function embedContent($content, array $options = [])
    {
        // TODO: Implement embedContent() method.
        return uniqid();
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        $string = '';
        if ($this->_textBody !== null) {
            $string .= $this->_textBody;
        }

        if ($this->_htmlBody !== null) {
            if ($this->_textBody !== null) {
                $string .= PHP_EOL;
            }
            $string .= $this->_htmlBody;
        }

        return $string;
    }
}

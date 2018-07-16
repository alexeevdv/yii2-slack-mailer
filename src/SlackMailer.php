<?php

namespace alexeevdv\yii;

use Maknz\Slack\Client as SlackClient;
use Maknz\Slack\Message;
use Yii;
use yii\base\InvalidConfigException;
use yii\mail\BaseMailer;

/**
 * Class SlackMailer
 * @package alexeevdv\yii
 */
class SlackMailer extends BaseMailer
{
    /**
     * @inheritdoc
     */
    public $messageClass = SlackMailerMessage::class;

    /**
     * @inheritdoc
     */
    public $useFileTransport = false;

    /**
     * @var string
     */
    public $webhook;

    /**
     * :emoji: or URL to image
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $channel;

    /**
     * @var string
     */
    public $username;

    /**
     * @var bool
     */
    public $link_names = false;

    /**
     * @var bool
     */
    public $unfurl_links = true;

    /**
     * @var bool
     */
    public $unfurl_media = true;

    /**
     * @var bool
     */
    public $allow_markdown = true;

    /**
     * @var SlackClient
     */
    private $_client;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->webhook) {
            throw new InvalidConfigException('`webhook` is required.');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function sendMessage($message)
    {
        $payload = $this->getSlackClient()->createMessage();

        $this->attachSubject($payload, $message);
        $this->attachFrom($payload, $message);
        $this->attachTo($payload, $message);

        $payload->attach([
            'text' => $message->toString(),
            'color' => strlen($message->toString()) ? 'good' : 'danger',
        ]);

        try {
            $payload->send();
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return false;
        }
        return true;
    }

    /**
     * @return SlackClient
     */
    private function getSlackClient()
    {
        if (!$this->_client) {
            $this->_client = Yii::createObject(SlackClient::class, [$this->webhook, $this->getOptions()]);
        }
        return $this->_client;
    }

    /**
     * @return array
     */
    private function getOptions()
    {
        $options = [
            'icon' => $this->icon,
            'username' => $this->username,
            'channel' => $this->channel,
            'link_names' => $this->link_names,
            'unfurl_links' => $this->unfurl_links,
            'unfurl_media' => $this->unfurl_media,
            'allow_markdown' => $this->allow_markdown,
        ];
        return array_filter($options, function ($option) {
            return !is_null($option);
        });
    }

    /**
     * @param Message $payload
     * @param SlackMailerMessage $mesage
     */
    private function attachSubject(Message $payload, SlackMailerMessage $message)
    {
        $payload->attach([
            'text' => 'Subject: ' . $message->getSubject(),
            'color' => strlen($message->getSubject()) ? 'good' : 'danger',
        ]);
    }

    /**
     * @param Message $payload
     * @param SlackMailerMessage $message
     */
    private function attachFrom(Message $payload, SlackMailerMessage $message)
    {
        $from = $message->getFrom();
        $payload->attach([
            'text' => 'From: ' . (is_array($from) ? reset($from) . ' <' . key($from) . '>' : $from),
            'color' => $from ? 'good' : 'danger',
        ]);
    }

    /**
     * @param Message $payload
     * @param SlackMailerMessage $message
     */
    private function attachTo(Message $payload, SlackMailerMessage $message)
    {
        $to = $message->getTo();
        $payload->attach([
            'text' => 'To: ' . (is_array($to) ? reset($to) . ' <' . key($to) . '>' : $to),
            'color' => $to ? 'good' : 'danger',
        ]);
    }
}

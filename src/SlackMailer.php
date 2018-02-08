<?php

namespace alexeevdv\slack\mailer;

use Maknz\Slack\Client as SlackClient;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\mail\BaseMailer;

/**
 * Class SlackMailer
 * @package alexeevdv\slack\mailer
 */
class SlackMailer extends BaseMailer
{
    /**
     * @inheritdoc
     */
    public $messageClass = SlackMessage::class;

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
    public $unfurl_links = false;

    /**
     * @var bool
     */
    public $unfurl_media = true;

    /**
     * @var bool
     */
    public $allow_markdown = true;

    /**
     * @var array
     */
    public $attachmentOptions = [
        'color' => 'danger',
    ];

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
        $attachment = ArrayHelper::merge(
            $this->attachmentOptions,
            [
                'text' => $message->toString(),
            ]
        );
        $this->getSlackClient()->attach($attachment)->send();
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
}

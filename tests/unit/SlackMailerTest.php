<?php

namespace tests\unit;

use alexeevdv\mailer\SlackMailer;
use alexeevdv\mailer\SlackMailerMessage;
use Codeception\Stub;
use Yii;
use yii\base\InvalidConfigException;

/**
 * Class SlackMailerTest
 * @package tests\unit
 */
class SlackMailerTest extends \Codeception\Test\Unit
{
    /**
     * @var \tests\UnitTester
     */
    public $tester;

    /**
     * @test
     */
    public function init()
    {
        // Webhook params should be required
        $this->tester->expectException(InvalidConfigException::class, function () {
            new SlackMailer;
        });
        new SlackMailer(['webhook' => 'my-web-hook']);
    }

    /**
     * @test
     */
    public function sendMessageThatCantBeDelivered()
    {
        Yii::$container->setSingleton(\Maknz\Slack\Client::class, function () {
            return Stub::make(\Maknz\Slack\Client::class, [
                'createMessage'  => function () {
                    return Stub::make(\Maknz\Slack\Message::class, [
                        'send' => function () {
                            throw new \GuzzleHttp\Exception\TransferException;
                        },
                    ]);
                },
            ]);
        });

        $message = new SlackMailerMessage;
        $mailer = new SlackMailer(['webhook' => 'my-web-hook']);
        $return = $mailer->send($message);
        $this->tester->assertEquals(
            false,
            $return,
            'Check that correct delivery status is returned'
        );
    }

    /**
     * @test
     */
    public function sendMessageThatCanBeDelivered()
    {
        Yii::$container->setSingleton(\Maknz\Slack\Client::class, function () {
            return Stub::make(\Maknz\Slack\Client::class, [
                'createMessage'  => function () {
                    return Stub::make(\Maknz\Slack\Message::class, [
                        'send' => function () {
                        },
                    ]);
                },
            ]);
        });

        $message = new SlackMailerMessage;
        $mailer = new SlackMailer(['webhook' => 'my-web-hook']);
        $return = $mailer->send($message);
        $this->tester->assertEquals(
            true,
            $return,
            'Check that correct delivery status is returned'
        );
    }
}

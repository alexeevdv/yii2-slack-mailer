<?php

namespace tests\unit;

use alexeevdv\slack\SlackMailerMessage;

/**
 * Class SlackMailerMessageTest
 * @package tests\unit
 */
class SlackMailerMessageTest extends \Codeception\Test\Unit
{
    /**
     * @var \tests\UnitTester
     */
    public $tester;

    /**
     * @test
     */
    public function setAndGetCharset()
    {
        $message = new SlackMailerMessage([
            'charset' => 'windows-1251',
        ]);
        $this->tester->assertEquals(
            'windows-1251',
            $message->getCharset(),
            'Charset should be the same as set via constructor'
        );

        $return = $message->setCharset('utf-8');
        $this->tester->assertEquals(
            'utf-8',
            $message->getCharset(),
            'Charset should be the same as set via setter'
        );
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setAndGetFrom()
    {
        $message = new SlackMailerMessage([
            'from' => 'mail@example.org',
        ]);
        $this->tester->assertEquals(
            'mail@example.org',
            $message->getFrom(),
            'Mail should be the same as set via constructor'
        );

        $return = $message->setFrom(['mail2@example.org' => 'John Doe']);
        $this->tester->assertEquals(
            ['mail2@example.org' => 'John Doe'],
            $message->getFrom(),
            'Mail should be the same as set via setter'
        );
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setAndGetTo()
    {
        $message = new SlackMailerMessage([
            'to' => 'mail@example.org',
        ]);
        $this->tester->assertEquals(
            'mail@example.org',
            $message->getTo(),
            'Mail should be the same as set via constructor'
        );

        $return = $message->setTo(['mail2@example.org' => 'John Doe']);
        $this->tester->assertEquals(
            ['mail2@example.org' => 'John Doe'],
            $message->getTo(),
            'Mail should be the same as set via setter'
        );
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setAndGetReplyTo()
    {
        $message = new SlackMailerMessage([
            'replyTo' => 'mail@example.org',
        ]);
        $this->tester->assertEquals(
            'mail@example.org',
            $message->getReplyTo(),
            'Mail should be the same as set via constructor'
        );

        $return = $message->setReplyTo(['mail2@example.org' => 'John Doe']);
        $this->tester->assertEquals(
            ['mail2@example.org' => 'John Doe'],
            $message->getReplyTo(),
            'Mail should be the same as set via setter'
        );
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setAndGetCc()
    {
        $message = new SlackMailerMessage([
            'cc' => 'mail@example.org',
        ]);
        $this->tester->assertEquals(
            'mail@example.org',
            $message->getCc(),
            'Mail should be the same as set via constructor'
        );

        $return = $message->setCc(['mail2@example.org' => 'John Doe']);
        $this->tester->assertEquals(
            ['mail2@example.org' => 'John Doe'],
            $message->getCc(),
            'Mail should be the same as set via setter'
        );
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setAndGetBcc()
    {
        $message = new SlackMailerMessage([
            'bcc' => 'mail@example.org',
        ]);
        $this->tester->assertEquals(
            'mail@example.org',
            $message->getBcc(),
            'Mail should be the same as set via constructor'
        );

        $return = $message->setBcc(['mail2@example.org' => 'John Doe']);
        $this->tester->assertEquals(
            ['mail2@example.org' => 'John Doe'],
            $message->getBcc(),
            'Mail should be the same as set via setter'
        );
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setAndGetSubject()
    {
        $message = new SlackMailerMessage([
            'subject' => 'Hello there!',
        ]);
        $this->tester->assertEquals(
            'Hello there!',
            $message->getSubject(),
            'Subject should be the same as set via constructor'
        );

        $return = $message->setSubject('Password recovery');
        $this->tester->assertEquals(
            'Password recovery',
            $message->getSubject(),
            'Subject should be the same as set via setter'
        );
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setTextBody()
    {
        $message = new SlackMailerMessage;

        $return = $message->setTextBody('Hello world!');
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function setHtmlBody()
    {
        $message = new SlackMailerMessage;

        $return = $message->setHtmlBody('<strong>Hello world!</strong>');
        $this->tester->assertEquals($return, $message, 'Setter should return object instance for chaining');
    }

    /**
     * @test
     */
    public function attach()
    {
        $message = new SlackMailerMessage;

        $return = $message->attach('fileName');
        $this->tester->assertEquals($return, $message, 'Method should return object instance for chaining');
    }

    /**
     * @test
     */
    public function attachContent()
    {
        $message = new SlackMailerMessage;

        $return = $message->attachContent('content');
        $this->tester->assertEquals($return, $message, 'Method should return object instance for chaining');
    }

    /**
     * @test
     */
    public function embed()
    {
        $message = new SlackMailerMessage;

        $return = $message->embed('fileName');
        $this->tester->assertNotEmpty($return, $message, 'Method should return attachment CID');
    }

    /**
     * @test
     */
    public function embedContent()
    {
        $message = new SlackMailerMessage;

        $return = $message->embedContent('content');
        $this->tester->assertNotEmpty($return, $message, 'Method should return attachment CID');
    }

    /**
     * @test
     */
    public function toString()
    {
        $message = new SlackMailerMessage;
        $this->tester->assertEquals(
            '',
            (string) $message,
            'Empty should be used if Text and HTML bodies are not set'
        );

        $message = new SlackMailerMessage;
        $message->setTextBody('Text');
        $this->tester->assertEquals(
            'Text',
            (string) $message,
            'Text body should be used if HTML body is not set'
        );

        $message = new SlackMailerMessage;
        $message->setHtmlBody('<strong>HTML</strong>');
        $this->tester->assertEquals(
            '<strong>HTML</strong>',
            (string) $message,
            'HTML body should be used if text body is not set'
        );

        $message = new SlackMailerMessage;
        $message->setTextBody('Text');
        $message->setHtmlBody('<strong>HTML</strong>');
        $this->tester->assertEquals(
            'Text' . PHP_EOL . '<strong>HTML</strong>',
            (string) $message,
            'Text and HTML body should be used if both are set'
        );
    }
}

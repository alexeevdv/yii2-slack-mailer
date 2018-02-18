yii2-slack-mailer
=================
[![Build Status](https://travis-ci.org/alexeevdv/yii2-slack-mailer.svg?branch=master)](https://travis-ci.org/alexeevdv/yii2-slack-mailer) ![PHP 5.6](https://img.shields.io/badge/PHP-5.6-green.svg) ![PHP 7.0](https://img.shields.io/badge/PHP-7.0-green.svg) ![PHP 7.1](https://img.shields.io/badge/PHP-7.1-green.svg) ![PHP 7.2](https://img.shields.io/badge/PHP-7.2-green.svg)

Yii2 mailer implementation that send mails to specified webhook.

![Preview](https://raw.githubusercontent.com/alexeevdv/yii2-slack-mailer/master/preview.jpg)


## Installation

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```bash
$ php composer.phar require alexeevdv/yii2-slack-mailer "~1.0"
```

or add

```
"alexeevdv/yii2-slack-mailer": "~1.0"
```

to the ```require``` section of your `composer.json` file.

## Configuration

### Through application component
```php
use alexeevdv\slack\SlackMailer;

//...
'components' => [
    //...
    'mailer' => [
        'class' => SlackMailer::class,
        'webhook' => 'https://your_webhook_link',
    ],
    //...
],
//...
```

## Available params

* **webhook**
  * description: Your webhook URL
  * required: true
  * type: string

* **icon**
  * description: :emoji: or URL to image
  * required: false
  * type: string

* **channel**
  * description: Channel name
  * required: false
  * type: string

* **username**
  * description: Bot name
  * required: false
  * type: string

* **link_names**
  * required: false
  * type: boolean
  * default: false

* **unfurl_links**
  * required: false
  * type: boolean
  * default: true

* **unfurl_media**
  * required: false
  * type: boolean
  * default: true
  
* **allow_markdown**
  * required: false
  * type: boolean
  * default: true

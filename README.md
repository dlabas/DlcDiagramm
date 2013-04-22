DlcDiagramm
===================
A simple digramm module for Zend Framework 2 based applications.

This module is currently under heavy development.

## Introduction

Comming soon...

Requirements
------------
* [DlcBase](https://github.com/dlabas/DlcBase)

Installation
------------

## Main Setup

#### By cloning project

1. Install the [DlcBase](https://github.com/dlabas/DlcBase) ZF2 module
   by cloning it into `./vendor/`.
2. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project and [DlcDiagramm](https://github.com/dlabas/DlcDiagramm) in your composer.json:

    ```json
    "require": {
        "dl-commons/dlc-diagramm": "dev-master"
    }
    ```

2. Now tell composer to download DlcDiagramm by running the command:

    ```bash
    $ php composer.phar update

#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'DlcBase',
            'DlcDiagramm',
        ),
        // ...
    );


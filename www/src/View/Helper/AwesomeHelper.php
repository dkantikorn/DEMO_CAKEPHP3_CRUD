<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AwesomeHelper
 *
 * @author sarawutt.b
 */

namespace App\View\Helper;

use Cake\View\Helper;
//use Cake\View\View;
use Cake\View\StringTemplateTrait;

class AwesomeHelper extends Helper {

    use StringTemplateTrait;

    protected $_defaultConfig = [
        'errorClass' => 'error',
        'templates' => [
            'label' => '<label for="{{for}}">{{content}}</label>',
        ],
    ];

    // initialize() hook is available since 3.2. For prior versions you can
    // override the constructor if required.
    public function initialize(array $config) {
        parent::initialize($config);
        debug($config);
        exit;
    }

}

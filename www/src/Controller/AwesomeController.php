<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;

/**
 * Description of AwesomeController
 *
 * @author sarawutt.b
 */
class AwesomeController extends AppController {

    public $helpers = ['Awesome' => ['option1' => 'Value1', 'option2' => 'Value2']];

    public function index(){
        debug('xxx');exit;
    }
}

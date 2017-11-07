<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilityComponent
 *
 * @author sarawutt.b
 */

namespace App\Controller\Component;

use Cake\Controller\Component;

class UtilityComponent extends Component {

    public $components = ['Common'];
    
    public function doComplexOperation($amount1, $amount2) {
        echo $this->Common->printCommon() . "\n";
        return $amount1 + $amount2;
    }

}

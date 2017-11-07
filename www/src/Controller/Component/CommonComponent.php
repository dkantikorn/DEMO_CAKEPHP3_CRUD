<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Description of CommonComponent
 *
 * @author sarawutt.b
 */
class CommonComponent extends Component {

    public function printCommon() {
        return __('This is common Component');
    }

}

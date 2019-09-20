<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Log\Log;
use App\Controller\Component\CrazyLogComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;

set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit", -1);

/**
 * Hello shell command.
 */
class PositionSalaryCleansingDataShell extends Shell {

    private $CrazyLog = null;
    private $LOG_PATH = null;
    private $CURRENT_PATH = null;

    public function initialize() {
        parent::initialize();
        $this->CrazyLog = new CrazyLogComponent(new ComponentRegistry(), []);
        //$this->CURRENT_PATH = dirname(__FILE__);
        $this->LOG_PATH = $this->CURRENT_PATH . DS . 'logs' . DS;
        $this->loadModel('ActivityLogs');
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main() {
        //$this->out($this->OptionParser->help());
        $this->out('Hi, Sarawutt.b');
        $this->cleansingDateIssue();
    }

    public function cleansingDateIssue() {
        $this->out("========================= Cleansing date issue =========================");
        $this->loadModel("PositionSalaries");

        $sql = "SELECT id,card_no,salary,issue_date,ref_command_date 
                FROM position_salaries 
                WHERE issue_date NOT REGEXP '^([0-3][0-9])/([01][0-9])/25[0-6][0-9]$' 
                ORDER BY id
                LIMIT 10;";

        $connection = ConnectionManager::get('master');
        $results = $connection->execute($sql)->fetchAll('assoc');

        $updateData = [];
        for ($i = 0; $i < count($results); $i++) {
            //list($tmpDate, $tmpMonth, $tmpYear) = explode('/', $results[$i]['issue_date']);
            $positionSalaryID = $results[$i]['id'];
            $originalIssueDate = $results[$i]['issue_date'];
            $tmpInput = explode('/', $originalIssueDate);

            if (array_key_exists(2, $tmpInput)) {
                //$this->out("Process cleansing issue_date...");
                $tmpDate = trim($tmpInput[0]);
                $tmpMonth = trim($tmpInput[1]);
                $tmpYear = $tmpInput[2];

                $date = (strlen($tmpDate) == 1) ? "0{$tmpDate}" : $tmpDate;
                $month = (strlen($tmpMonth) == 1) ? "0{$tmpMonth}" : $tmpMonth;
                $year = $this->checkYear(trim($tmpYear));

                $issueDateCleansing = "{$date}/{$month}/{$year}";

                $updateData = ['issue_date' => $issueDateCleansing, 'issue_date_prev' => $originalIssueDate, 'remark' => 'CLEANSING_ISSUE_DATE'];
                $updateConditions = ['id' => $positionSalaryID];
                $connection->update('position_salaries', $updateData, $updateConditions);

                $this->out("=== ISSUE DATE === : $issueDateCleansing");
            } else {
                $this->out("=======> Can't not cleansing missing for value date <=======");
            }

            //unset($results[$i]);
            //$this->out("input: {$tmpDate}/{$tmpMonth}/{$tmpYear}");
        }
        //$results = $this->PositionSalaries->excecute($sql)->fetchAll("assoc");
        $this->out("=========================================================== END CLEANSING ===========================================================");
        //$this->cleansingDateIssue();
    }

    public function checkDate($date = null) {
//        if (strlen($date) == 1) {
//            return str_pad($date, 2, '0', STR_PAD_LEFT);
//        }
        //return (strlen($date) == 1) ? str_pad($date, 2, '0', STR_PAD_LEFT) : $date;
        return (strlen($date) == 1) ? "0{$date}" : $date;
    }

    public function checkMonth($month = null) {
        //return (strlen($month) == 1) ? str_pad($month, 2, '0', STR_PAD_LEFT) : $month;
        return (strlen($month) == 1) ? "0{$month}" : $month;
    }

    public function checkYear($year = null) {
        if (is_null($year) || empty($year) || !is_numeric($year)) {
            return $year;
        }


        //แปลงเป็นปี พ.ศ.
        if ($year < 2019) {
            $year += 543;
        }
        return $year;
    }

}

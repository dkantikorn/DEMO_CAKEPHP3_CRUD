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
        $this->CURRENT_PATH = dirname(__FILE__);
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
        //$this->out('Hi, Sarawutt.b');
        //$this->cleansingDateIssue();
        $this->cleansingRefCommandDate();
    }

    /**
     * 
     * Function making for cleansing for missing ref_command_date
     * @author sarawutt.b
     */
    public function cleansingRefCommandDate() {
        $this->out("========================= CLEANSING REF_COMMAND_DATE =========================");

        $this->loadModel("PositionSalaries");
        $dateValidPattern = '^([0-3][0-9])/([01][0-9])/25[0-6][0-9]$';
        $pragValidPattern = '/' . preg_replace('/\//', '\/', $dateValidPattern) . '/';
        $logFileName = 'ref_command_date_position_salaries';

//        // LOT#1
//        $sql = "SELECT id,issue_date,ref_command_date ,remark
//                FROM position_salaries 
//                WHERE ref_command_date NOT REGEXP '{$dateValidPattern}' AND ref_command_date IS NOT NULL AND TRIM(ref_command_date) <> '' AND remark NOT IN('CLEANSING_ISSUE_DATE_MANUAL|CLEANSING_REF_COMMAND_DATE_MANUAL','CLEANSING_REF_COMMAND_DATE_MANUAL')
//                ORDER BY id
//                LIMIT 5000;";
        // LOT#2
//        $sql = "SELECT id,card_no,salary,issue_date,ref_command_date,issue_date_prev,ref_command_date_prev,remark
//                FROM position_salaries 
//                WHERE ref_command_date REGEXP '^([0-3][0-9])/([01][0-9])/[0-6][0-9]$' AND ref_command_date IS NOT NULL AND TRIM(ref_command_date) <> ''
//                ORDER BY id;";
        // LOT#3
//        $sql = "SELECT id,issue_date,ref_command_date ,remark
//                FROM position_salaries 
//                WHERE ref_command_date NOT REGEXP '{$dateValidPattern}' AND ref_command_date IS NOT NULL AND TRIM(ref_command_date) <> ''
//                ORDER BY id;";
        // LOT#4                
        $sql = "SELECT id,card_no,salary,ref_command_date,ref_command_date_prev,remark
                FROM position_salaries 
                WHERE ref_command_date REGEXP '^([0-9])/([0-3][0-9])/25[0-6][0-9]$' AND ref_command_date IS NOT NULL AND TRIM(ref_command_date) <> '';";


        $connection = ConnectionManager::get('master');
        $results = $connection->execute($sql)->fetchAll('assoc');
        $countResultItems = count($results);
        $updateData = [];

        //dd($results);
        if (!empty($results) || ($countResultItems > 0)) {
            for ($i = 0; $i < $countResultItems; $i++) {
                $positionSalaryID = $results[$i]['id'];
                $originalIssueDate = trim($results[$i]['ref_command_date']);
                $tmpRemark = trim($results[$i]['remark']);

                $remark = ($tmpRemark == 'CLEANSING_ISSUE_DATE_MANUAL') ? $tmpRemark . '|' . 'CLEANSING_REF_COMMAND_DATE_MANUAL' : 'CLEANSING_REF_COMMAND_DATE_MANUAL';
                $tmpInput = explode('/', $originalIssueDate);
                $updateConditions = ['id' => $positionSalaryID];

                $updateData = [];
                $updateDataMissing = ['ref_command_date' => $originalIssueDate, 'ref_command_date_prev' => $originalIssueDate, 'remark' => $remark, 'modified' => 'NOW()'];

                if (array_key_exists(2, $tmpInput)) {
                    $tmpDate = trim($tmpInput[1]);
                    $tmpMonth = trim($tmpInput[0]);
                    $tmpYear = $tmpInput[2];

                    $date = ( strlen($tmpDate) == 1) ? "0{$tmpDate}" : $tmpDate;
                    $month = (strlen($tmpMonth) == 1) ? "0{$tmpMonth}" : $tmpMonth;
                    $year = $this->checkYear(trim($tmpYear));
                    $issueDateCleansing = "{$date}/{$month}/{$year}";

                    if (preg_match($pragValidPattern, $issueDateCleansing)) {
                        $this->out("====== VALID REF COMMAND DATE : $issueDateCleansing =====");
                        $updateData = ['ref_command_date' => $issueDateCleansing, 'ref_command_date_prev' => $originalIssueDate, 'remark' => $remark];
                    } else {
                        $this->out("+++++ INVALID REF COMMAND DATE : $issueDateCleansing +++++");
                        $this->writeLogMissingUpdateIssueDate($updateDataMissing, $positionSalaryID, $logFileName);
                        $updateData = ['remark' => $remark];
                    }
                } else {
                    $this->out("=== CAN'T UPDATE REF COMMAND DATE ===");

                    $updateData = ['remark' => $remark];
                    $this->writeLogMissingUpdateIssueDate($updateDataMissing, $positionSalaryID, $logFileName);
                }
                $connection->update('position_salaries', $updateData, $updateConditions);
            }//END LOOP UPDATE RESULT
            //unset($results);
            //$this->cleansingDateIssue();
        } else {
            $this->out("=========================================================== END CLEANSING ===========================================================");
            return true;
        }
    }

    /**
     * 
     * Function making for cleansing for missing issue_date
     * @author sarawutt.b
     */
    public function cleansingDateIssue() {
        $this->out("========================= CLEANSING DATE_ISSUE =========================");

        $this->loadModel("PositionSalaries");
        $dateValidPattern = '^([0-3][0-9])/([01][0-9])/25[0-6][0-9]$';
        $pragValidPattern = '/' . preg_replace('/\//', '\/', $dateValidPattern) . '/';
        $logFileName = 'date_issue_position_salaries_missing';
// LOT#1
//        $sql = "SELECT id,issue_date,ref_command_date 
//                FROM position_salaries 
//                WHERE issue_date NOT REGEXP '{$dateValidPattern}' AND issue_date IS NOT NULL AND TRIM(issue_date) <> '' AND remark <> 'CLEANSING_ISSUE_DATE_MANUAL'
//                ORDER BY id
//                LIMIT 5000;";
        // LOT#2
//        $sql = "SELECT id,card_no,salary,issue_date,ref_command_date,issue_date_prev,ref_command_date_prev
//                FROM position_salaries 
//                WHERE issue_date REGEXP '^([0-3][0-9])/([01][0-9])/[0-6][0-9]$' AND issue_date IS NOT NULL AND TRIM(issue_date) <> ''
//                ORDER BY id
//                LIMIT 5000;";
//                
// LOT#3                
        $sql = "SELECT id,card_no,salary,issue_date,ref_command_date,issue_date_prev,ref_command_date_prev
                FROM position_salaries 
                WHERE issue_date REGEXP '^([0-9])/([01][0-9])/25[0-6][0-9]$' AND issue_date IS NOT NULL AND TRIM(issue_date) <> ''
                ORDER BY id;";



        $connection = ConnectionManager::get('master');
        $results = $connection->execute($sql)->fetchAll('assoc');
        $countResultItems = count($results);
        $updateData = [];

        //dd($results);
        if (!empty($results) || ($countResultItems > 0)) {
            for ($i = 0; $i < $countResultItems; $i++) {
                $positionSalaryID = $results[$i]['id'];
                $originalIssueDate = $results[$i]['issue_date'];
                $tmpInput = explode('/', $originalIssueDate);
                $updateConditions = ['id' => $positionSalaryID];


                $updateData = [];
                $updateDataMissing = ['issue_date' => $originalIssueDate, 'issue_date_prev' => $originalIssueDate, 'remark' => 'CLEANSING_ISSUE_DATE_MANUAL', 'modified' => 'NOW()'];

                if (array_key_exists(2, $tmpInput)) {
                    $tmpDate = trim($tmpInput[0]);
                    $tmpMonth = trim($tmpInput[1]);
                    $tmpYear = $tmpInput[2];

                    $date = ( strlen($tmpDate) == 1) ? "0{$tmpDate}" : $tmpDate;
                    $month = (strlen($tmpMonth) == 1) ? "0{$tmpMonth}" : $tmpMonth;
                    $year = $this->checkYear(trim($tmpYear));
                    $issueDateCleansing = "{$date}/{$month}/{$year}";

                    if (preg_match($pragValidPattern, $issueDateCleansing)) {
                        $this->out("====== VALID ISSUE DATE : $issueDateCleansing =====");
                        $updateData = ['issue_date' => $issueDateCleansing, 'issue_date_prev' => $originalIssueDate, 'remark' => 'CLEANSING_ISSUE_DATE'];
                    } else {
                        $this->out("+++++ INVALID ISSUE DATE : $issueDateCleansing +++++");
                        $this->writeLogMissingUpdateIssueDate($updateDataMissing, $positionSalaryID, $logFileName);
                        $updateData = ['remark' => 'CLEANSING_ISSUE_DATE_MANUAL'];
                    }
                } else {
                    $this->out("=== CAN'T UPDATE ISSUE DATE ===");

                    $updateData = ['remark' => 'CLEANSING_ISSUE_DATE_MANUAL'];
                    $this->writeLogMissingUpdateIssueDate($updateDataMissing, $positionSalaryID, $logFileName);
                }
                $connection->update('position_salaries', $updateData, $updateConditions);
            }//END LOOP UPDATE RESULT
            //unset($results);
            //$this->cleansingDateIssue();
        } else {
            $this->out("=========================================================== END CLEANSING ===========================================================");
            return true;
        }
    }

    /**
     * 
     * Function making for create log file
     * @author sarawutt.b
     * @param type $data
     * @param type $id
     * @param type $logFileName
     * @return boolean
     */
    public function writeLogMissingUpdateIssueDate($data, $id, $logFileName) {
        //$updateData = ['issue_date' => $originalIssueDate, 'issue_date_prev' => $originalIssueDate, 'remark' => 'CLEANSING_ISSUE_DATE_MANUAL', 'modified' => 'NOW()'];
        $sql = $this->generateUpdateSQL("position_salaries", $data, ['id' => $id]);
        $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, $logFileName . '_error.log');
        $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, " $id,", $logFileName . '_id.log');
        return true;
    }

    public function checkDate($date = null) {
//        if (strlen($date) == 1) {
//            return str_pad($date, 2, '0', STR_PAD_LEFT);
//        }
        //return (strlen($date) == 1) ? str_pad($date, 2, '0', STR_PAD_LEFT) : $date;
        return ( strlen($date) == 1) ? "0{$date}" :
                $date;
    }

    public function checkMonth($month = null) {
        //return (strlen($month) == 1) ? str_pad($month, 2, '0', STR_PAD_LEFT) : $month;
        return ( strlen($month) == 1) ? "0{$month}" :
                $month;
    }

    public function checkYear($year = null) {
        if (is_null($year) || empty($year) || !is_numeric($year)) {
            return $year;
        }
        //แปลงเป็นปี พ.ศ.
        // LOT#1
        if ($year < 2020) {
            $year += 543;
        }
        return $year;
        // LOT#2
        //return '25' . $year;
    }

    private function generateInsertSQL($tablename, $params) {
        $key = array_keys($params);
        $val = array_values($params);
        //sanitation needed!
        $query = "INSERT INTO $tablename  (" . implode(', ', $key) . ") " . "VALUES ('" . implode("', '", $val) . "');";

        return

                $query;
    }

    private function generateUpdateSQL($tablename, $params, $conditions) {
        $setField = "";
        $conditionSTR = "WHERE 1 = 1";
        foreach ($params as $key => $val) {
            if ($key == 'modified') {
                $setField .= " {$key
                        } = {$val
                        },";
            } else {
                $setField .= " {$key
                        } = '{$val
                        }',";
            }
        }

        foreach ($conditions as $key => $val) {
            $conditionSTR .= " AND {$key} = {$val}";
        }

        $setField = trim($setField, ',');
        $query = "UPDATE $tablename SET {$setField} $conditionSTR;";

        return $query;
    }

}

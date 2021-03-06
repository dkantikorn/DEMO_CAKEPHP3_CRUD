<?php

/**
 * 
 * Load large for the excel file example
 * @link https://github.com/PHPOffice/PhpSpreadsheet/issues/629
 * 
 * PhpOffice\PhpSpreadsheets document
 * @link https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/
 */

namespace App\Shell;

use Cake\Console\Shell;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Cake\Log\Log;
use App\Controller\Component\CrazyLogComponent;
use Cake\Controller\ComponentRegistry;
use SebastianBergmann\Timer\Timer as PHP_Timer;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

//use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
//use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit", -1);

/**
 * Hello shell command.
 */
class NewSchoolImportShell extends Shell {

    //public $components = ['CrazyLog'];
    private $resultFiles = [];
    private $lastCurrentPath = null;
    private $columnRows = 1;
    private $dataRows = 2;
    private $CrazyLog = null;
    private $LOG_PATH = null;
    private $CURRENT_PATH = null;
    private $CUSTOMER_REF = null;
    private $COUNT_ALL_FILES = 0;
    private $UNREAD_LOG_PATH = null;
    private $SELFDIR = null;

    public function initialize() {
        parent::initialize();
        $this->CrazyLog = new CrazyLogComponent(new ComponentRegistry(), []);
        //$this->CURRENT_PATH = dirname(__FILE__);
        $this->SELFDIR = $this->CURRENT_PATH = __DIR__;
        $this->LOG_PATH = $this->CURRENT_PATH . DS . 'logs' . DS;
        $this->loadModel('ActivityLogs');
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
//    public function main() {
//        $timer = new PHP_Timer();
//        $timer->start();
//        $this->out('========================    PROJECT SCHOOL IMPORT    ========================');
//        $this->importSchoolData();
//        $this->out("Totoal process time\n" . $timer->resourceUsage());
//    }

    private $countSaveSuccess = 0;
    private $countSaveFailed = 0;

    function testSpoutReadLargeExcelFile() {
        $this->out("testSpoutReadLargeExcelFile()");
        $filePath = 'D:\xampp7\htdocs\DEMO_CAKEPHP3_CRUD\www\src\Shell\import\schools\โรงเรียนพรหมราษฎร์รังสรรค์ Eok\บางบอน_รร.พรหมราษฎร์รังสรรค์_3740100233226_45721_นงนุช_เจนจิรา.xlsx';
        //$filePath = 'D:\xampp7\htdocs\DEMO_CAKEPHP3_CRUD\www\src\Shell\import\schools\โรงเรียนพรหมราษฎร์รังสรรค์ Eok\รหัส Beacon งาน Aquarium_URL.xlsx';
        //$reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            // $this->out("sheet");
            debug($sheet->getName());
            //Log::debug("Sheet: " . json_encode($sheet));

            if ($sheet->getName() == "3ตำแหน่ง-เงินเดือน") {
                foreach ($sheet->getRowIterator() as $index => $row) {
                    //$this->out("row");
                    //Log::debug("row: " . json_encode($row));
                    //debug($row[1]);
                    // do stuff with the row

                    if ($index < 10) {
                        $cells = $row->getCells();
                        $this->out($index);
                    } else {
                        exit;
                    }
//                    $cells = $row->getCells();
//                    $this->out("cells");
//                    Log::debug("cell: " . json_encode($cells));
                }
            }

            if ($sheet->getName() == "ปลา1 + 2") {
                foreach ($sheet->getRowIterator() as $index => $row) {
                    //$this->out("row");
                    //Log::debug("row: " . json_encode($row));

                    if ($index < 20) {
                        $cells = $row->getCells();
                        $this->out($cells[0] . "\t" . $cells[1] . "\t" . $cells[2]);
                    }
                    // do stuff with the row
//                    $cells = $row->getCells();
//                    $this->out("cells");
//                    Log::debug("cell: " . json_encode($cells));
                }
            }
        }

        $reader->close();
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main() {
        $timer = new PHP_Timer();
        $timer->start();
        $this->out('========================    PROJECT SCHOOL IMPORT    ========================');
        $importPath = __DIR__ . DS . 'import' . DS . 'schools';
        $file_mimes = ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $this->listAllSchoolFile($importPath);
        $this->COUNT_ALL_FILES = count($this->resultFiles, true) - count($this->resultFiles);
        if ($this->COUNT_ALL_FILES > 0) {

            $this->out("Main: Read all files {$this->COUNT_ALL_FILES} files.");
            foreach ($this->resultFiles as $path => $fileList) {
                foreach ($fileList as $filename) {

                    //Read all file data and insert
                    $readCurrent = $path . DS . $filename;
                    try {
                        if (!is_file($readCurrent)) {
                            continue;
                        }

                        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        $this->out("Main:: read current file name :: " . $readCurrent);
                        Log::debug("Main:: read current file name :: " . $readCurrent);

                        $reader = ReaderEntityFactory::createXLSXReader();
                        $reader->setShouldPreserveEmptyRows(true);
                        $reader->setShouldFormatDates(true);
                        $reader->open($readCurrent);

                        foreach ($reader->getSheetIterator() as $sheet) {
                            $sheetName = trim($sheet->getName());
                            $this->out('Current read sheet name: ' . $sheetName);


                            if ($sheetName == '3ตำแหน่ง-เงินเดือน') {
                                $this->ActivityLogs->logInfo("PositionSalaries", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $result = $this->newImportPositionSalariesInfos($sheet, $readCurrent);

                                //debug("{$result} from called function");
                            } else {
                                //If sheetname not match remove to not mat sheetname
                                //$this->moveFileInvalidSheetnameQueues($readCurrent);
                            }
                        }

                        $reader->close();
                        $this->moveFileSuccessQueues($readCurrent);
                    } catch (\Exception $ex) {
                        $msg = json_encode($ex);
                        $this->out("Main:: error exception:: " . $msg);
                        Log::error("Main:: error exception:: " . $msg);
                        $this->ActivityLogs->logError('Main', "error exception", $msg);
                        $this->moveFileExceptionQueues($readCurrent);
                        continue;
                    }
                }
            }
            //Remove empty directory
            $this->removeEmptySubFolders($importPath);
        }

        $this->out("Totoal process time\n" . $timer->resourceUsage());
    }

    /**
     * 
     * Import personal data (ข้อมูลตำแหน่ง และเงินเดือน)
     * import to position_salaries table
     * @param type $datas by reference
     */
    private function newImportPositionSalariesInfos(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countLoopContinue = 0;
            $loopSkipped = 5;
            $this->loadModel('PositionSalaries');

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    //debug($columnNames);exit;
                    continue;
                }



                $data = [];
                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;

                if (array_key_exists('เงินเดือน', $columnNames)) {
                    $data['salary'] = @$cells[$columnNames['เงินเดือน']] . '';
                } else {
                    $data['salary'] = @$cells[11] . '';
                }


                if (empty($data['card_no']) || empty($data['salary'])) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out('($countLoopContinue > $loopSkipped) = true then return true');
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }

                if (array_key_exists('ลำดับที่', $columnNames)) {
                    $data['order_no'] = @$cells[$columnNames['ลำดับที่']] . '';
                } else {
                    $data['order_no'] = @$cells[1] . '';
                }





                if (array_key_exists('วัน/เดือน/พ.ศ.', $columnNames)) {
                    $data['issue_date'] = $cells[$columnNames['วัน/เดือน/พ.ศ.']] . '';
                } else {
                    $data['issue_date'] = @$cells[2] . '';
                }

                if (array_key_exists('ตำแหน่ง', $columnNames)) {
                    $data['position_name'] = @$cells[$columnNames['ตำแหน่ง']] . '';
                } else {
                    $data['position_name'] = @$cells[3] . '';
                }

                if (array_key_exists('วิทยฐานะ', $columnNames)) {
                    $data['acadamic_standing'] = @$cells[$columnNames['วิทยฐานะ']] . '';
                } else {
                    $data['acadamic_standing'] = @$cells[4] . '';
                }

                if (array_key_exists('รับเงินเดือนระดับ', $columnNames)) {
                    $data['position_level'] = @$cells[$columnNames['รับเงินเดือนระดับ']] . '';
                } else {
                    $data['position_level'] = @$cells[5] . '';
                }


                if (array_key_exists('สำนักงานเขค', $columnNames)) {
                    $data['affiliation'] = @$cells[$columnNames['สำนักงานเขค']] . '';
                } elseif (array_key_exists('สำนักงานเขต', $columnNames)) {
                    $data['affiliation'] = @$cells[$columnNames['สำนักงานเขต']] . '';
                } else {
                    $data['affiliation'] = @$cells[6] . '';
                }

                if (array_key_exists('โรงเรียน', $columnNames)) {
                    $data['school'] = @$cells[$columnNames['โรงเรียน']] . '';
                } else {
                    $data['school'] = @$cells[7] . '';
                }

                if (array_key_exists('อื่น ๆ', $columnNames)) {
                    $data['other'] = @$cells[$columnNames['อื่น ๆ']] . '';
                } else {
                    $data['other'] = @$cells[8] . '';
                }

                if (array_key_exists('ตำแหน่งเดิม (ข้อความช่องตำแหน่งทั้งหมด)', $columnNames)) {
                    $data['prev_position'] = @$cells[$columnNames['ตำแหน่งเดิม (ข้อความช่องตำแหน่งทั้งหมด)']] . '';
                } elseif (array_key_exists('ตำแหน่งเดิม', $columnNames)) {
                    $data['prev_position'] = @$cells[$columnNames['ตำแหน่งเดิม']] . '';
                } else {
                    $data['prev_position'] = @$cells[9] . '';
                }

                if (array_key_exists('เลขที่ตำแหน่ง', $columnNames)) {
                    $data['position_no'] = @$cells[$columnNames['เลขที่ตำแหน่ง']] . '';
                } else {
                    $data['position_no'] = @$cells[10] . '';
                }


//                if (array_key_exists('เงินเดือน', $columnNames)) {
//                    $data['salary'] = @$cells[$columnNames['เงินเดือน']] . '';
//                } else {
//                    $data['salary'] = @$cells[11] . '';
//                }


                if (array_key_exists('ขั้น', $columnNames)) {
                    $data['salary_level'] = @$cells[$columnNames['ขั้น']] . '';
                } else {
                    $data['salary_level'] = @$cells[12] . '';
                }



                if (array_key_exists('code', $columnNames)) {
                    $data['code'] = @$cells[$columnNames['code']] . '';
                } else {
                    $data['code'] = @$cells[13] . '';
                }


                if (array_key_exists('อ้างอิง', $columnNames)) {
                    $data['ref_title_name'] = @$cells[$columnNames['อ้างอิง']] . '';
                } else {
                    $data['ref_title_name'] = @$cells[14] . '';
                }

                if (array_key_exists('เลขที่คำสั่ง', $columnNames)) {
                    $data['ref_command_follow'] = @$cells[$columnNames['เลขที่คำสั่ง']] . '';
                } else {
                    $data['ref_command_follow'] = @$cells[15] . '';
                }

                if (array_key_exists('เลขที่คำสั่ง', $columnNames)) {
                    $data['ref_command_no'] = @$cells[$columnNames['เลขที่คำสั่ง'] + 1] . '';
                } else {
                    $data['ref_command_no'] = @$cells[16] . '';
                }


                if (array_key_exists('ลงวันที่', $columnNames)) {
                    $data['ref_command_date'] = @$cells[$columnNames['ลงวันที่']] . '';
                } else {
                    $data['ref_command_date'] = @$cells[17] . '';
                }

                if (array_key_exists('แก้ไข', $columnNames)) {
                    $data['edit_remark'] = @$cells[$columnNames['แก้ไข']] . '';
                } else {
                    $data['edit_remark'] = @$cells[18] . '';
                }

                if (array_key_exists('อ้างอิงทั้งหมด', $columnNames)) {
                    $data['ref_full'] = @$cells[$columnNames['อ้างอิงทั้งหมด']] . '';
                } else {
                    $data['ref_full'] = @$cells[19] . '';
                }


                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $positionSalary = $this->PositionSalaries->newEntity();
                $positionSalary = $this->PositionSalaries->patchEntity($positionSalary, $data);
                if ($this->PositionSalaries->save($positionSalary)) {
                    $this->countSaveSuccess++;

                    $currSaveStr = $positionSalary->id;
                    $this->out('PositionSalaries:: save success with id :: ' . $currSaveStr);
                    $this->ActivityLogs->logInfo('PositionSalaries', "save success with id {$currSaveStr}");
                } else {

                    $this->countSaveFailed++;
                    $this->out("PositionSalaries:: insert failed error:: ");
                    $sql = $this->generateInsertSQL('position_salaries', $data);
                    Log::debug("PositionSalaries:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, 'insert_position_salaries_error.log');
                    $this->ActivityLogs->logError('PositionSalaries', "save error", $sql);
                }
            }//end foreach

            $strSummary = "PositionSalaries:: SUMMARY:: SUCCESS: {$this->countSaveSuccess}, FAILED: {$this->countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo('PositionSalaries -> SUMMARY', "insert position_salaries summary:: SUCCESS: {$this->countSaveSuccess}, FAILED: {$this->countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, 'PositionSalaries', 'position_salaries');
            return false;
        }//End catch
    }

    /**
     * 
     * Import personal data (ข้อมูลตำแหน่ง และเงินเดือน)
     * import to position_salaries table
     * @param type $datas by reference
     */
    private function importPositionSalariesInfos(&$datas, $currentPath) {
        if (is_array($datas) && (count($datas) > 0)) {
            $data = [];
            try {
                $countLoopContinue = 0;
                $loopSkipped = 5;

                $this->loadModel('PositionSalaries');
                foreach ($datas as $k => $v) {
                    if ($k < $this->dataRows) {
                        //debug($v);
                        continue;
                    }

                    $v = $this->trimAllData($v);
                    if (empty(array_filter($v))) {
                        ++$countLoopContinue;
                        if ($countLoopContinue > $loopSkipped) {
                            unset($datas);
                            return true;
                        }
//                        debug($v);
                        debug($countLoopContinue);
                        continue;
                    }


                    // debug($v);exit;


                    $data = [];
                    $this->CUSTOMER_REF = $data['card_no'] = @$v[0];
                    if (empty($data['card_no'])) {
                        continue;
                    }

                    $data['order_no'] = @$v[1];
                    $data['issue_date'] = @$v[2];
                    $data['position_name'] = @$v[3];
                    $data['acadamic_standing'] = @$v[4];
                    $data['salary_level'] = @$v[5];
                    $data['affiliation'] = @$v[6];
                    $data['school'] = @$v[7];
                    $data['other'] = @$v[8];
                    $data['prev_position'] = @$v[9];
                    $data['position_no'] = @$v[10];
                    $data['salary'] = @$v[11];
                    $data['position_level'] = @$v[12];
                    $data['code'] = @$v[13];
                    $data['ref_title_name'] = @$v[14];
                    $data['ref_command_follow'] = @$v[15];
                    $data['ref_command_no'] = @$v[16];
                    $data['ref_command_date'] = @$v[17];
                    $data['edit_remark'] = @$v[18];
                    $data['ref_full'] = @$v[19];





                    $data['source_file'] = str_replace(DS, DS . DS, $currentPath);

//                    debug("PersonalInfo:: Data" . json_encode($data));
//                    Log::debug("PersonalInfo:: Data" . json_encode($data));
//
//                    exit;
                    $positionSalary = $this->PositionSalaries->newEntity();
                    $positionSalary = $this->PositionSalaries->patchEntity($positionSalary, $data);
                    if ($this->PositionSalaries->save($positionSalary)) {
                        $this->countSaveSuccess++;

                        $currSaveStr = $positionSalary->id . '/' . $this->COUNT_ALL_FILES;
                        //$currSaveStr = $k . '/' . $this->COUNT_ALL_FILES;
                        $this->out('PositionSalaries:: save success with id :: ' . $currSaveStr);
                        //Log::debug("PositionSalaries:: save success:: with id :: " . $personalInfo->id);
                        $this->ActivityLogs->logInfo('PositionSalaries', "save success with id {$currSaveStr}");
                    } else {

                        $this->countSaveFailed++;
                        $this->out("PositionSalaries:: insert failed error:: ");
                        $sql = $this->generateInsertSQL('position_salaries', $data);
                        Log::debug("PositionSalaries:: save error:: " . $sql);
                        $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, 'insert_position_salaries_error.log');
                        $this->ActivityLogs->logError('PositionSalaries', "save error", $sql);
                    }


                    unset($datas[$k]);
                }//End foreach for save Position salaries
                $strSummary = "PositionSalaries:: SUMMARY:: SUCCESS: {$this->countSaveSuccess}, FAILED: {$this->countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";

                $this->out($strSummary);
                $this->ActivityLogs->logInfo('SUMMARY', "insert position_salaries summary:: SUCCESS: {$this->countSaveSuccess}, FAILED: {$this->countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
                Log::debug($strSummary);
            } catch (\Exception $ex) {
                $this->catchForException($ex, $data, 'PositionSalaries', 'position_salaries');
            }
        }
    }

    /**
     * 
     * Function Handle catch exception
     * @author  sarawutt.b
     * @param type $ex
     * @param type $data
     * @param type $modelClass
     * @param type $tableName
     */
    private function catchForException($ex, $data, $modelClass, $tableName) {
        $msg = json_encode($ex);
        $this->out("{$modelClass}:: error exception:: " . $msg);
        Log::error("{$modelClass}:: error exception:: " . $msg);
        $this->ActivityLogs->logError($modelClass, "error exception", $msg);
        $sql = $this->generateInsertSQL($tableName, $data);
        $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
        $this->ActivityLogs->logError($modelClass, "error exception", $sql);
    }

    /**
     * 
     * Import personal data (ข้อมูลพื้นฐาน)
     * @param type $datas by reference
     */
    private function importPersonalInfos(&$datas, $currentPath) {
        if (is_array($datas) && (count($datas) > 0)) {
            $data = [];
            try {
                $this->loadModel('PersonalInfos');
                foreach ($datas as $k => $v) {
                    if ($k < $this->dataRows) {
                        continue;
                    }

                    $v = $this->trimAllData($v);
                    if (empty(array_filter($v))) {
                        continue;
                    }

                    $data = [];
                    $this->CUSTOMER_REF = $data['card_no'] = @$v[0];
                    $data['ref_no'] = @$v[1];
                    $data['name_prefix'] = @$v[2];
                    $data['first_name'] = @$v[3];
                    $data['last_name'] = @$v[4];
                    $data['gender'] = @$v[5];
                    $data['date_of_birth'] = @$v[6];
                    $data['marital_status'] = @$v[7];
                    $data['blood_group'] = @$v[8];
                    $data['physical_status'] = @$v[9];
                    $data['issue_date'] = @$v[10];
                    $data['start_date'] = @$v[11];
                    $data['school'] = @$v[12];
                    $data['position_no'] = @$v[13];
                    $data['position_name'] = @$v[14];
                    $data['position_level'] = @$v[15];
                    $data['phone_no'] = @$v[16];
                    $data['father_name_prefix'] = @$v[17];
                    $data['father_first_name'] = @$v[18];
                    $data['father_last_name'] = @$v[19];
                    $data['mother_name_prefix'] = @$v[20];
                    $data['mother_first_name'] = @$v[21];
                    $data['mother_last_name'] = @$v[22];
                    $data['spouse_name_prefix'] = @$v[23];
                    $data['spouse_first_name'] = @$v[24];
                    $data['spouse_last_name'] = @$v[25];
                    $data['source_file'] = str_replace(DS, DS . DS, $currentPath);

//                    debug("PersonalInfo:: Data" . json_encode($data));
//                    Log::debug("PersonalInfo:: Data" . json_encode($data));
//
//                    exit;
                    $personalInfo = $this->PersonalInfos->newEntity();
                    $personalInfo = $this->PersonalInfos->patchEntity($personalInfo, $data);
                    if ($this->PersonalInfos->save($personalInfo)) {
                        $this->countSaveSuccess++;

                        $currSaveStr = $personalInfo->id . '/' . $this->COUNT_ALL_FILES;
                        //$currSaveStr = $k . '/' . $this->COUNT_ALL_FILES;
                        //$this->out('PersonalInfo:: save success with id :: ' . $currSaveStr);
                        //Log::debug("PersonalInfo:: save success:: with id :: " . $personalInfo->id);
                        $this->ActivityLogs->logInfo('PersonalInfo', "save success with id {$currSaveStr}");
                    } else {
                        $this->countSaveFailed++;

                        $this->out("PersonalInfo:: insert failed error:: ");
                        $sql = $this->generateInsertSQL('personal_infos', $data);
                        Log::debug("PersonalInfo:: save error:: " . $sql);
                        $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, 'insert_personal_infos_error.log');
                        $this->ActivityLogs->logError('PersonalInfo', "save error", $sql);
                    }
                }//End foreach for save Personal infomation
                $strSummary = "PersonalInfo:: SUMMARY:: SUCCESS: {$this->countSaveSuccess}, FAILED: {$this->countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";

                $this->out($strSummary);
                $this->ActivityLogs->logInfo('SUMMARY', "insert personal_infos summary:: SUCCESS: {$this->countSaveSuccess}, FAILED: {$this->countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
                Log::debug($strSummary);
            } catch (\Exception $ex) {
                $msg = json_encode($ex);
                $this->out("PersonalInfo:: error exception:: " . $msg);
                Log::error("PersonalInfo:: error exception:: " . $msg);
                $this->ActivityLogs->logError('PersonalInfo', "error exception", $msg);

                $sql = $this->generateInsertSQL('personal_infos', $data);
                $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, 'insert_personal_infos_error.log');
                $this->ActivityLogs->logError('PersonalInfo', "error exception", $sql);
            }
        }
    }

    private function listFolderFiles($dir) {
        $ffs = scandir($dir);
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);
        // prevent empty ordered elements;
        if (count($ffs) < 1) {
            return $this->resultFiles;
        }

        foreach ($ffs as $ff) {
            //echo '<li>' . $ff;
            $currentPath = $dir . DS . $ff;
            if (is_dir($currentPath)) {
                $this->lastCurrentPath = $currentPath;
                $this->listFolderFiles($this->lastCurrentPath);
            } else {

                //Filter out for tmp save excel temp file
                if (strpos($ff, '~$') !== false) {
                    $logMsg = "Read Excel:: Can not to read file name:: " . $currentPath;
                    $this->out($logMsg);
                    Log::debug($logMsg);
                    $this->ActivityLogs->logError("ReadFile", "can not to read file", str_replace(DS, DS . DS, $currentPath));
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $currentPath, 'cannot_read_error.log');
                } else {
                    $this->resultFiles[trim($dir)][] = trim($ff);
                }
            }

            //echo '</li>';
        }
        return $this->resultFiles;
        // echo '</ol>';
    }

    private function listAllSchoolFile($path) {
        //$path = dirname(__FILE__) . DS . 'import' . DS . 'schools' . DS;
        return $this->listFolderFiles($path);
    }

    private function checkEmpty($param) {
        $tmp = (empty($param) || is_null($param)) ? null : trim($param);
        return $tmp;
    }

    /**
     * Trim all data in params
     * @author  sarawutt.b
     * @param   data Mix type as data where you want to trim
     * @return  []
     * @since   2013-02-16
     */
    public function trimAllData(&$data = null) {
        $return_data = [];
        if (!is_array($data)) {
            $data = array($data);
        }

        if (empty($data))
            return [];
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $kk => $vv) {
                    @$return_data[$k][$kk] = trim($vv);
                }
            } else {
                $return_data[$k] = trim($v);
            }
        }
        return $return_data;
    }

    private function generateInsertSQL($tablename, $params) {
        $key = array_keys($params);
        $val = array_values($params);
        //sanitation needed!
        $query = "INSERT INTO $tablename (" . implode(', ', $key) . ") " . "VALUES ('" . implode("', '", $val) . "');";
        return $query;
    }

    /**
      Make a nested path , creating directories down the path
      Recursion !!
     */
    private function makePath($path) {
        $dir = pathinfo($path, PATHINFO_DIRNAME);
        if (is_dir($dir)) {
            return true;
        } else {
            if ($this->makePath($dir)) {
                if (mkdir($dir)) {
                    chmod($dir, 0777);
                    return true;
                }
            }
        }

        return false;
    }

    private function moveFile($sourceFile, $destinationPath) {
        $sourceFile = str_replace(DS, DS . DS, $sourceFile);
        $this->makePath($destinationPath);

        //may be duplicate name
        //rename($sourceFile, $destinationPath . pathinfo($sourceFile, PATHINFO_BASENAME));
        rename($sourceFile, $destinationPath);
    }

    private function moveFileSuccessQueues($sourceFile) {
        $destinationPath = str_replace('schools', 'SUCCESS-QUEUES', $sourceFile);
        return $this->moveFile($sourceFile, $destinationPath);
    }

    private function moveFileInvalidSheetnameQueues($sourceFile) {
        $destinationPath = str_replace('schools', 'INVALID-SHEETNAME-QUEUES', $sourceFile);
        return $this->moveFile($sourceFile, $destinationPath);
    }

    private function moveFileExceptionQueues($sourceFile) {
        $destinationPath = str_replace('schools', 'EXCEPTION-QUEUES', $sourceFile);
        return $this->moveFile($sourceFile, $destinationPath);
    }

    private function moveFileFailedQueues($sourceFile) {
        $destinationPath = str_replace('schools', 'FAILED-QUEUES', $sourceFile);
        return $this->moveFile($sourceFile, $destinationPath);
    }

    private function moveFileInvalidExcelQueues($sourceFile) {
        $destinationPath = str_replace('schools', 'FAILED-INVALID-QUEUES', $sourceFile);
        return $this->moveFile($sourceFile, $destinationPath);
    }

    public function removeEmptySubFolders($dir) {

        try {
            $dirScan = @scandir($dir);
            if (empty($dirScan)) {
                return true;
            }
            $files = array_diff($dirScan, ['.', '..']);
//        if (is_array($files) && !empty($files)) {
//            foreach ($files as $file) {
//                $currentPath = $dir . DS . $file;
//                if ((is_dir($currentPath))) {
//                    $this->removeEmptySubFolders($currentPath);
//                } else {
//                    if (strpos($file, '~$') !== false) {
//                        $msg = "DeleteFile:: delete tmp file:: " . $file;
//                        $this->out($msg);
////                    $this->ActivityLogs->logError("DeleteFile", "can not to read file", str_replace(DS, DS . DS, $currentPath));
////                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $currentPath, 'cannot_read_error.log');
//                        Log::debug($msg);
//                        @unlink($currentPath);
//                        $this->removeEmptySubFolders($dir);
//                    }
//                }
//            }
//            if (count($files) < 1) {
//                $msg = "DeleteFile:: delete tmp directory:: " . $dir;
//                $this->out($msg);
//                @rmdir($dir);
//            } else {
//                return true;
//            }
//        } else {
//            return true;
//        }

            foreach ($files as $file) {
                $currentPath = $dir . DS . $file;
                if ((is_dir($currentPath))) {
                    $this->removeEmptySubFolders($currentPath);
                } else {
                    if (strpos($file, '~$') !== false) {
                        $msg = "DeleteFile:: delete tmp file:: " . $file;
                        $this->out($msg);
//                    $this->ActivityLogs->logError("DeleteFile", "can not to read file", str_replace(DS, DS . DS, $currentPath));
//                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $currentPath, 'cannot_read_error.log');
                        Log::debug($msg);
                        @unlink($currentPath);
                        $this->removeEmptySubFolders($dir);
                    }
                }
            }
            if (count($files) < 1) {
                $msg = "DeleteFile:: delete tmp directory:: " . $dir;
                $this->out($msg);
                @rmdir($dir);
            } else {
                return true;
            }
        } catch (\Exception $ex) {
            $msg = json_encode($ex);
            //$this->out("removeEmptySubFolders:: error exception:: " . $msg);
            Log::error("removeEmptySubFolders:: error exception:: " . $msg);
            return false;
        }
    }

}

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
use Cake\Utility\Inflector;

//use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
//use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit", -1);

/**
 * EducationalsSchoolImportShell shell command.
 */
class EducationalsSchoolImportShell extends Shell {

    //public $components = ['CrazyLog'];
    private $resultFiles = [];
    private $lastCurrentPath = null;
    private $columnRows = 1;
    private $dataRows = 2;
    private $dataRowsListName = [];
    private $CrazyLog = null;
    private $LOG_PATH = null;
    private $CURRENT_PATH = null;
    private $CUSTOMER_REF = null;
    private $COUNT_ALL_FILES = 0;
    private $UNREAD_LOG_PATH = null;
    private $SELFDIR = null;
    private $countSaveSuccess = 0;
    private $countSaveFailed = 0;

    public function initialize() {
        parent::initialize();
        $this->CrazyLog = new CrazyLogComponent(new ComponentRegistry(), []);
        $this->CURRENT_PATH = dirname(__FILE__);
        $this->SELFDIR = $this->CURRENT_PATH = __DIR__;
        $this->LOG_PATH = $this->CURRENT_PATH . DS . 'logs' . DS;
        $this->loadModel('ActivityLogs');
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
                                //$this->ActivityLogs->logInfo("PositionSalaries", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                //$result = $this->newImportPositionSalariesInfos($sheet, $readCurrent);
                            }

                            if (in_array($sheetName, ['ประวัติการศึกษา', 'การศึกษา'])) {
                                $this->ActivityLogs->logInfo("Educationals", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $this->out('============================================    START IMPORT EDUCTIONALS  ============================================');
                                $result = $this->importEducationals($sheet, $readCurrent);
                                $this->out('============================================    COMPLETE IMPORT EDUCTIONALS  ============================================');
                            }
                            
                            if (in_array($sheetName, ['ประวัติการลา', 'การลา'])) {
                                $this->ActivityLogs->logInfo("LeaveRecords", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $this->out('============================================    START IMPORT LEAVE RECORDS  ============================================');
                                $result = $this->importLeaveRecords($sheet, $readCurrent);
                                $this->out('============================================    COMPLETE IMPORT LEAVE RECORDS  ============================================');
                            }

                            if (in_array($sheetName, ['ประวัติเครื่องราชฯ', 'เครื่องราชฯ'])) {
                                $this->ActivityLogs->logInfo("Insignias", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $this->out('============================================    START IMPORT INSIGNIAS  ============================================');
                                $result = $this->importInsignias($sheet, $readCurrent);
                                $this->out('============================================    COMPLETE IMPORT INSIGNIAS  ============================================');
                            }

                            if (in_array($sheetName, ['ประวัติการอบรม', 'การอบรม', 'อบรม'])) {
                                $this->ActivityLogs->logInfo("Trainings", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $this->out('============================================    START IMPORT TRAININGS  ============================================');
                                $result = $this->importTrainings($sheet, $readCurrent);
                                $this->out('============================================    COMPLETE IMPORT TRANINGS  ============================================');
                            }

                            if (in_array($sheetName, ['ประวัติราชการพิเศษ', 'ราชการพิเศษ'])) {
                                $this->ActivityLogs->logInfo("SpecialCivils", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $this->out('============================================    START IMPORT SPECIAL CIVILS  ============================================');
                                $result = $this->importSpecialCivils($sheet, $readCurrent);
                                $this->out('============================================    COMPLETE IMPORT SPECIAL CIVILS  ============================================');
                            }

                            if (in_array($sheetName, ['ประวัติความสามารถ', 'ความสามารถ', 'ความสามารถพิเศษ'])) {
                                $this->ActivityLogs->logInfo("Talents", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $this->out('============================================    START IMPORT TALENTS  ============================================');
                                $result = $this->importTalents($sheet, $readCurrent);
                                $this->out('============================================    COMPLETE IMPORT TALENTS  ============================================');
                            }
                            
                            if (in_array($sheetName, ['รายการอื่น', 'อื่นๆ'])) {
                                $this->ActivityLogs->logInfo("ListOthers", "read current file name", str_replace(DS, DS . DS, $readCurrent));
                                $this->out('============================================    START IMPORT LIST OTHERS  ============================================');
                                $result = $this->importListOthers($sheet, $readCurrent);
                                $this->out('============================================    COMPLETE IMPORT LIST OTHERS  ============================================');
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
     * Import personal data (รายการอื่น / อื่นๆ)
     * Sheet name [รายการอื่น]
     * import to list_others table
     * @param type $datas by reference
     */
    private function importListOthers(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countSaveSuccess = $countSaveFailed = $countLoopContinue = 0;
            $loopSkipped = 10;
            $model = 'ListOthers';
            $tableName = Inflector::tableize(Inflector::singularize($model));
            $this->loadModel($model);

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();
                $data = [];

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    continue;
                }

                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;

                if (array_key_exists('ลำดับที่', $columnNames)) {
                    $data['order_no'] = @$cells[$columnNames['ลำดับที่']] . '';
                } else {
                    $data['order_no'] = @$cells[1] . '';
                }

//                if (array_key_exists('วันที่', $columnNames)) {
//                    $data['issue_date'] = @$cells[$columnNames['วันที่']] . '';
//                } else {
//                    $data['issue_date'] = @$cells[2] . '';
//                }

                if (array_key_exists('รายการ', $columnNames)) {
                    $data['name'] = @$cells[$columnNames['รายการ']] . '';
                } else {
                    $data['name'] = @$cells[2] . '';
                }

                if (empty($data['card_no']) || empty($data['name'])) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out("($countLoopContinue > $loopSkipped) = true then return true");
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }

                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $data = $this->trimAllData($data);
                $modelEntities = $this->{$model}->newEntity();
                $saveData = $this->{$model}->patchEntity($modelEntities, $data);

                if ($this->{$model}->save($saveData)) {
                    $countSaveSuccess++;
                    $currSaveStr = $saveData->id;
                    $this->out("$model:: save success with id :: {$currSaveStr}");
                    $this->ActivityLogs->logInfo($model, "save success with id {$currSaveStr}");
                } else {
                    $countSaveFailed++;
                    $this->out("$model:: insert failed error:: ");
                    $sql = $this->generateInsertSQL($tableName, $data);
                    Log::debug("{$model}:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
                    $this->ActivityLogs->logError($model, "save error", $sql);
                }
            }//end foreach

            $strSummary = "{$model}:: SUMMARY:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo("{$model} -> SUMMARY", "insert {$tableName} summary:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, $model, $tableName);
            return false;
        }//End catch
    }
    
    
    /**
     * 
     * Import personal data (ประวัติความสามารถ / ความสามารถ)
     * Sheet name [ความสามารถ]
     * import to talents table
     * @param type $datas by reference
     */
    private function importTalents(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countSaveSuccess = $countSaveFailed = $countLoopContinue = 0;
            $loopSkipped = 10;
            $model = 'Talents';
            $tableName = Inflector::tableize(Inflector::singularize($model));
            $this->loadModel($model);

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();
                $data = [];

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    continue;
                }

                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;

                if (array_key_exists('ลำดับที่', $columnNames)) {
                    $data['order_no'] = @$cells[$columnNames['ลำดับที่']] . '';
                } else {
                    $data['order_no'] = @$cells[1] . '';
                }

                if (array_key_exists('วันที่', $columnNames)) {
                    $data['issue_date'] = @$cells[$columnNames['วันที่']] . '';
                } else {
                    $data['issue_date'] = @$cells[2] . '';
                }

                if (array_key_exists('รายการ', $columnNames)) {
                    $data['name'] = @$cells[$columnNames['รายการ']] . '';
                } else {
                    $data['name'] = @$cells[3] . '';
                }

                if (empty($data['card_no']) || empty($data['name'])) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out("($countLoopContinue > $loopSkipped) = true then return true");
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }

                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $data = $this->trimAllData($data);
                $modelEntities = $this->{$model}->newEntity();
                $saveData = $this->{$model}->patchEntity($modelEntities, $data);

                if ($this->{$model}->save($saveData)) {
                    $countSaveSuccess++;
                    $currSaveStr = $saveData->id;
                    $this->out("$model:: save success with id :: {$currSaveStr}");
                    $this->ActivityLogs->logInfo($model, "save success with id {$currSaveStr}");
                } else {
                    $countSaveFailed++;
                    $this->out("$model:: insert failed error:: ");
                    $sql = $this->generateInsertSQL($tableName, $data);
                    Log::debug("{$model}:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
                    $this->ActivityLogs->logError($model, "save error", $sql);
                }
            }//end foreach

            $strSummary = "{$model}:: SUMMARY:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo("{$model} -> SUMMARY", "insert {$tableName} summary:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, $model, $tableName);
            return false;
        }//End catch
    }

    /**
     * 
     * Import personal data (ประวัติราชการพิเศษ / ราชการพิเศษ)
     * Sheet name [ราชการพิเศษ]
     * import to special_civils table
     * @param type $datas by reference
     */
    private function importSpecialCivils(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countSaveSuccess = $countSaveFailed = $countLoopContinue = 0;
            $loopSkipped = 10;
            $model = 'SpecialCivils';
            $tableName = Inflector::tableize(Inflector::singularize($model));
            $this->loadModel($model);

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();
                $data = [];

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    continue;
                }

                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;

                if (array_key_exists('ลำดับที่', $columnNames)) {
                    $data['order_no'] = @$cells[$columnNames['ลำดับที่']] . '';
                } else {
                    $data['order_no'] = @$cells[1] . '';
                }

                if (array_key_exists('ปี พ.ศ.', $columnNames)) {
                    $data['issue_date'] = @$cells[$columnNames['ปี พ.ศ.']] . '';
                } else {
                    $data['issue_date'] = @$cells[2] . '';
                }

                if (array_key_exists('รายการ', $columnNames)) {
                    $data['name'] = @$cells[$columnNames['รายการ']] . '';
                } else {
                    $data['name'] = @$cells[3] . '';
                }

                if (empty($data['card_no']) || empty($data['name'])) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out("($countLoopContinue > $loopSkipped) = true then return true");
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }

                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $data = $this->trimAllData($data);
                $modelEntities = $this->{$model}->newEntity();
                $saveData = $this->{$model}->patchEntity($modelEntities, $data);

                if ($this->{$model}->save($saveData)) {
                    $countSaveSuccess++;
                    $currSaveStr = $saveData->id;
                    $this->out("$model:: save success with id :: {$currSaveStr}");
                    $this->ActivityLogs->logInfo($model, "save success with id {$currSaveStr}");
                } else {
                    $countSaveFailed++;
                    $this->out("$model:: insert failed error:: ");
                    $sql = $this->generateInsertSQL($tableName, $data);
                    Log::debug("{$model}:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
                    $this->ActivityLogs->logError($model, "save error", $sql);
                }
            }//end foreach

            $strSummary = "{$model}:: SUMMARY:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo("{$model} -> SUMMARY", "insert {$tableName} summary:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, $model, $tableName);
            return false;
        }//End catch
    }

    /**
     * 
     * Import personal data (ประวัติการอบรม / การอบรม)
     * Sheet name [การอบรม]
     * import to trainings table
     * @param type $datas by reference
     */
    private function importTrainings(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countSaveSuccess = $countSaveFailed = $countLoopContinue = 0;
            $loopSkipped = 8;
            $model = 'Trainings';
            $tableName = Inflector::tableize(Inflector::singularize($model));
            $this->loadModel($model);

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();
                $data = [];

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    continue;
                }

                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;

                if (array_key_exists('ลำดับที่', $columnNames)) {
                    $data['order_no'] = @$cells[$columnNames['ลำดับที่']] . '';
                } else {
                    $data['order_no'] = @$cells[1] . '';
                }

                if (array_key_exists('สถานที่', $columnNames)) {
                    $data['train_place'] = @$cells[$columnNames['สถานที่']] . '';
                } else {
                    $data['train_place'] = @$cells[2] . '';
                }

                if (array_key_exists('ตั้งแต่ (ปี)', $columnNames)) {
                    $data['start_date'] = @$cells[$columnNames['ตั้งแต่ (ปี)']] . '';
                } else {
                    $data['start_date'] = @$cells[3] . '';
                }

                if (array_key_exists('ถึง (ปี)', $columnNames)) {
                    $data['finish_date'] = @$cells[$columnNames['ถึง (ปี)']] . '';
                } else {
                    $data['finish_date'] = @$cells[4] . '';
                }

                if (array_key_exists('รายละเอียด', $columnNames)) {
                    $data['train_title'] = @$cells[$columnNames['รายละเอียด']] . '';
                } else {
                    $data['train_title'] = @$cells[5] . '';
                }

                if (empty($data['card_no']) || empty($data['train_title'])) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out("($countLoopContinue > $loopSkipped) = true then return true");
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }

                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $data = $this->trimAllData($data);
                $modelEntities = $this->{$model}->newEntity();
                $saveData = $this->{$model}->patchEntity($modelEntities, $data);

                if ($this->{$model}->save($saveData)) {
                    $countSaveSuccess++;
                    $currSaveStr = $saveData->id;
                    $this->out("$model:: save success with id :: {$currSaveStr}");
                    $this->ActivityLogs->logInfo($model, "save success with id {$currSaveStr}");
                } else {
                    $countSaveFailed++;
                    $this->out("$model:: insert failed error:: ");
                    $sql = $this->generateInsertSQL($tableName, $data);
                    Log::debug("{$model}:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
                    $this->ActivityLogs->logError($model, "save error", $sql);
                }
            }//end foreach

            $strSummary = "{$model}:: SUMMARY:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo("{$model} -> SUMMARY", "insert {$tableName} summary:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, $model, $tableName);
            return false;
        }//End catch
    }

    /**
     * 
     * Import personal data (เครื่องราชฯ)
     * Sheet name [เครื่องราชฯ]
     * import to insignias table
     * @param type $datas by reference
     */
    private function importInsignias(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countSaveSuccess = $countSaveFailed = $countLoopContinue = 0;
            $loopSkipped = 8;
            $model = 'Insignias';
            $tableName = Inflector::tableize(Inflector::singularize($model));
            $this->loadModel($model);

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();
                $data = [];

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    continue;
                }

                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;


//               'ลำดับที่'
                $data['order_no'] = @$cells[1] . '';

                if (array_key_exists('วันที่ได้รับ', $columnNames)) {
                    $data['issue_date'] = @$cells[$columnNames['วันที่ได้รับ']] . '';
                } else {
                    $data['issue_date'] = @$cells[2] . '';
                }

                if (array_key_exists('เครื่องราชอิสริยาภรณ์/เหรียญตรา', $columnNames)) {
                    $data['name'] = @$cells[$columnNames['เครื่องราชอิสริยาภรณ์/เหรียญตรา']] . '';
                } else {
                    $data['name'] = @$cells[3] . '';
                }

                if (array_key_exists('เล่ม/เล่มที่', $columnNames)) {
                    $data['book_no'] = @$cells[$columnNames['เล่ม/เล่มที่']] . '';
                } else {
                    $data['book_no'] = @$cells[4] . '';
                }

                if (array_key_exists('ตอนที่', $columnNames)) {
                    $data['section_no'] = @$cells[$columnNames['ตอนที่']] . '';
                } else {
                    $data['section_no'] = @$cells[5] . '';
                }

                if (array_key_exists('หน้าที่', $columnNames)) {
                    $data['page_no'] = @$cells[$columnNames['หน้าที่']] . '';
                } else {
                    $data['page_no'] = @$cells[6] . '';
                }

                //book_issue_date
                $data['book_order'] = @$cells[7] . '';


                if (array_key_exists('วันที่', $columnNames)) {
                    $data['book_issue_date'] = @$cells[$columnNames['วันที่']] . '';
                } else {
                    $data['book_issue_date'] = @$cells[8] . '';
                }

                if (empty($data['card_no']) || empty($data['name'])) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out("($countLoopContinue > $loopSkipped) = true then return true");
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }

                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $data = $this->trimAllData($data);
                $modelEntities = $this->{$model}->newEntity();
                $saveData = $this->{$model}->patchEntity($modelEntities, $data);

                if ($this->{$model}->save($saveData)) {
                    $countSaveSuccess++;
                    $currSaveStr = $saveData->id;
                    $this->out("$model:: save success with id :: {$currSaveStr}");
                    $this->ActivityLogs->logInfo($model, "save success with id {$currSaveStr}");
                } else {
                    $countSaveFailed++;
                    $this->out("$model:: insert failed error:: ");
                    $sql = $this->generateInsertSQL($tableName, $data);
                    Log::debug("{$model}:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
                    $this->ActivityLogs->logError($model, "save error", $sql);
                }
            }//end foreach

            $strSummary = "{$model}:: SUMMARY:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo("{$model} -> SUMMARY", "insert {$tableName} summary:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, $model, $tableName);
            return false;
        }//End catch
    }

    /**
     * 
     * Import personal data (ประวัติ / การลา)
     * Sheet name [การลา]
     * import to educationals table
     * @param type $datas by reference
     */
    private function importLeaveRecords(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countSaveSuccess = $countSaveFailed = $countLoopContinue = 0;
            $loopSkipped = 8;
            $model = 'LeaveRecords';
            $tableName = Inflector::tableize(Inflector::singularize($model));
            $this->loadModel($model);

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();
                $data = [];

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    continue;
                }

                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;


                if (array_key_exists('ลำดับที่', $columnNames)) {
                    $data['order_no'] = @$cells[$columnNames['ลำดับที่']] . '';
                } else {
                    $data['order_no'] = @$cells[1] . '';
                }

                if (array_key_exists('วัน/เดือน/พ.ศ.', $columnNames)) {
                    $data['issue_year'] = @$cells[$columnNames['วัน/เดือน/พ.ศ.']] . '';
                } else {
                    $data['issue_year'] = @$cells[2] . '';
                }

                if (array_key_exists('ลาป่วย', $columnNames)) {
                    $data['sick_leave'] = @$cells[$columnNames['ลาป่วย']] . '';
                } else {
                    $data['sick_leave'] = @$cells[3] . '';
                }

                if (array_key_exists('ลากิจ', $columnNames)) {
                    $data['errand_leave'] = @$cells[$columnNames['ลากิจ']] . '';
                } else {
                    $data['errand_leave'] = @$cells[4] . '';
                }

                if (array_key_exists('ลาพักผ่อน', $columnNames)) {
                    $data['holiday_leave'] = @$cells[$columnNames['ลาพักผ่อน']] . '';
                } else {
                    $data['holiday_leave'] = @$cells[5] . '';
                }

                if (array_key_exists('ลาคลอด', $columnNames)) {
                    $data['maternity_leave'] = @$cells[$columnNames['วุฒิการศึกษา']] . '';
                } else {
                    $data['maternity_leave'] = @$cells[6] . '';
                }

                if (array_key_exists('ลาช่วยภริยาคลอดบุตร', $columnNames)) {
                    $data['husband_maternity_leave'] = @$cells[$columnNames['ลาช่วยภริยาคลอดบุตร']] . '';
                } else {
                    $data['husband_maternity_leave'] = @$cells[7] . '';
                }

                if (array_key_exists('ลาอุปสมบท/พิธีฮัจย์', $columnNames)) {
                    $data['ordination_leave'] = @$cells[$columnNames['ลาอุปสมบท/พิธีฮัจย์']] . '';
                } else {
                    $data['ordination_leave'] = @$cells[8] . '';
                }

                if (array_key_exists('ลาเข้ารับการตรวจเลือก/เตรียมพล', $columnNames)) {
                    $data['military_leave'] = @$cells[$columnNames['ลาเข้ารับการตรวจเลือก/เตรียมพล']] . '';
                } else {
                    $data['military_leave'] = @$cells[9] . '';
                }

                if (array_key_exists('ลาศึกษาต่อ', $columnNames)) {
                    $data['edu_leave'] = @$cells[$columnNames['ลาศึกษาต่อ']] . '';
                } else {
                    $data['edu_leave'] = @$cells[10] . '';
                }

                if (array_key_exists('ลาปฏิบัติงานในองค์การระหว่างประเทศ', $columnNames)) {
                    $data['inter_work_leave'] = @$cells[$columnNames['ลาปฏิบัติงานในองค์การระหว่างประเทศ']] . '';
                } else {
                    $data['inter_work_leave'] = @$cells[11] . '';
                }

                if (array_key_exists('ลาติดตามคู่สมรส', $columnNames)) {
                    $data['follow_spouse_leave'] = @$cells[$columnNames['ลาติดตามคู่สมรส']] . '';
                } else {
                    $data['follow_spouse_leave'] = @$cells[12] . '';
                }

                if (array_key_exists('ลาฟื้นฟูสมรรถภาพ', $columnNames)) {
                    $data['rehabilitation_leave'] = @$cells[$columnNames['ลาฟื้นฟูสมรรถภาพ']] . '';
                } else {
                    $data['rehabilitation_leave'] = @$cells[13] . '';
                }

                if (empty($data['card_no']) || empty($data['issue_year']) || ($data['issue_year'] == 0)) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out("($countLoopContinue > $loopSkipped) = true then return true");
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }



                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $data = $this->trimAllData($data);
                $modelEntities = $this->{$model}->newEntity();
                $saveData = $this->{$model}->patchEntity($modelEntities, $data);


                if ($this->{$model}->save($saveData)) {
                    $countSaveSuccess++;
                    $currSaveStr = $saveData->id;
                    $this->out("$model:: save success with id :: {$currSaveStr}");
                    $this->ActivityLogs->logInfo($model, "save success with id {$currSaveStr}");
                } else {
                    $countSaveFailed++;
                    $this->out("$model:: insert failed error:: ");
                    $sql = $this->generateInsertSQL($tableName, $data);
                    Log::debug("{$model}:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
                    $this->ActivityLogs->logError($model, "save error", $sql);
                }
            }//end foreach

            $strSummary = "{$model}:: SUMMARY:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo("{$model} -> SUMMARY", "insert {$tableName} summary:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, $model, $tableName);
            return false;
        }//End catch
    }

    /**
     * 
     * Import personal data (ประวัติ / การศึกษา)
     * Sheet name [ประวัติการศึกษา]
     * import to educationals table
     * @param type $datas by reference
     */
    private function importEducationals(&$sheet, $currentPath) {
        $data = [];
        $columnNames = [];
        try {
            $countSaveSuccess = $countSaveFailed = $countLoopContinue = 0;
            $loopSkipped = 8;
            $model = 'Educationals';
            $tableName = Inflector::tableize(Inflector::singularize($model));
            $this->loadModel($model);

            foreach ($sheet->getRowIterator() as $index => $row) {
                $cells = $row->getCells();
                $data = [];

                //If first row then make column name
                if ($index == 1) {
                    $firstRows = [];
                    foreach ($cells as $key => $val) {
                        $firstRows[$key] = trim($val);
                    }
                    $columnNames = array_flip($firstRows);
                    continue;
                }

                if (array_key_exists('เลขประจำตัว', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัว']] . '';
                } else if (array_key_exists('เลขประจำตัวประชาชนครู', $columnNames)) {
                    $this->CUSTOMER_REF = @$cells[$columnNames['เลขประจำตัวประชาชนครู']] . '';
                } else {
                    $this->CUSTOMER_REF = @$cells[0] . '';
                }

                $data['card_no'] = $this->CUSTOMER_REF;


                if (array_key_exists('ลำดับที่', $columnNames)) {
                    $data['order_no'] = @$cells[$columnNames['ลำดับที่']] . '';
                } else {
                    $data['order_no'] = @$cells[1] . '';
                }

                if (array_key_exists('ระดับการศึกษา', $columnNames)) {
                    $data['edu_level'] = @$cells[$columnNames['ระดับการศึกษา']] . '';
                } else {
                    $data['edu_level'] = @$cells[2] . '';
                }

                if (array_key_exists('สถานศึกษา', $columnNames)) {
                    $data['school_name'] = @$cells[$columnNames['สถานศึกษา']] . '';
                } else {
                    $data['school_name'] = @$cells[3] . '';
                }

                if (array_key_exists('ตั้งแต่ (ปี)', $columnNames)) {
                    $data['from_year'] = @$cells[$columnNames['ตั้งแต่ (ปี)']] . '';
                } else {
                    $data['from_year'] = @$cells[4] . '';
                }

                if (array_key_exists('ถึง (ปี)', $columnNames)) {
                    $data['finish_year'] = @$cells[$columnNames['ถึง (ปี)']] . '';
                } else {
                    $data['finish_year'] = @$cells[5] . '';
                }

                if (array_key_exists('วุฒิการศึกษา', $columnNames)) {
                    $data['edu_background'] = @$cells[$columnNames['วุฒิการศึกษา']] . '';
                } else {
                    $data['edu_background'] = @$cells[6] . '';
                }

                if (array_key_exists('วิชาเอก', $columnNames)) {
                    $data['major'] = @$cells[$columnNames['วิชาเอก']] . '';
                } else {
                    $data['major'] = @$cells[7] . '';
                }

                if (empty($data['card_no']) || empty($data['edu_background'])) {
                    ++$countLoopContinue;
                    if ($countLoopContinue > $loopSkipped) {
                        $this->out("($countLoopContinue > $loopSkipped) = true then return true");
                        return true;
                    }
                    $this->out("current countLoopContinue : $countLoopContinue");
                    continue;
                }



                $data['source_file'] = str_replace(DS, DS . DS, $currentPath);
                $data = $this->trimAllData($data);
                $modelEntities = $this->{$model}->newEntity();
                $saveData = $this->{$model}->patchEntity($modelEntities, $data);

                if ($this->{$model}->save($saveData)) {
                    $countSaveSuccess++;
                    $currSaveStr = $saveData->id;
                    $this->out("$model:: save success with id :: {$currSaveStr}");
                    $this->ActivityLogs->logInfo($model, "save success with id {$currSaveStr}");
                } else {
                    $countSaveFailed++;
                    $this->out("$model:: insert failed error:: ");
                    $sql = $this->generateInsertSQL($tableName, $data);
                    Log::debug("{$model}:: save error:: " . $sql);
                    $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, "insert_{$tableName}_error.log");
                    $this->ActivityLogs->logError($model, "save error", $sql);
                }
            }//end foreach

            $strSummary = "{$model}:: SUMMARY:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}";
            $this->out($strSummary);
            $this->ActivityLogs->logInfo("{$model} -> SUMMARY", "insert {$tableName} summary:: SUCCESS: {$countSaveSuccess}, FAILED: {$countSaveFailed}, FILE: {$this->COUNT_ALL_FILES}");
            $this->out("=======================================================================================================================================================================");
            Log::debug($strSummary);
            return true;
        } catch (\Exception $ex) {
            $this->catchForException($ex, $data, $model, $tableName);
            return false;
        }//End catch
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

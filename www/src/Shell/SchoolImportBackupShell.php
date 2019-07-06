<?php

namespace App\Shell;

use Cake\Console\Shell;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Cake\Log\Log;
use App\Controller\Component\CrazyLogComponent;
use Cake\Controller\ComponentRegistry;
use SebastianBergmann\Timer\Timer as PHP_Timer;

set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit", -1);

//function exceptions_error_handler($severity, $message, $filename, $lineno) {
//    if (error_reporting() == 0) {
//        return;
//    }
//    if (error_reporting() & $severity) {
//        throw new ErrorException($message, 0, $severity, $filename, $lineno);
//    }
//}

/**
 * Hello shell command.
 */
class SchoolImportBackupShell extends Shell {

    //public $components = ['CrazyLog'];
    private $resultFiles = [];
    private $lastCurrentPath = null;
    private $dataRows = 1;
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
                    Log::debug("Read Excel:: Can not to read file name:: " . $currentPath);
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

//    private function importSchoolData() {
//        //$this->out('========================    PROJECT SCHOOL IMPORT    ========================');
//        $path = dirname(__FILE__) . DS . 'import' . DS . 'schools';
//        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//        $this->listAllSchoolFile($path);
//        $this->loadModel('PersonalInfos');
//        $this->loadModel('ActivityLogs');
//        $countFiles = count($this->resultFiles, true) - count($this->resultFiles);
//        if ($countFiles > 0) {
//
//            $this->out("PersonalInfo:: read {$countFiles} files.");
//
////            Log::debug("======================      Personal Information Import     ======================");
////            Log::debug("======================      Insert into table personal_infos     ======================");
////            Log::debug("PersonalInfo:: read {$countFiles} files.");
////            Log::debug("PersonalInfo:: read all of {$countFiles} list file :: " . json_encode($this->resultFiles));
////
////            $this->ActivityLogs->logInfo();
////            foreach ($this->resultFiles as $path => $filename) {
//            foreach ($this->resultFiles as $path => $fileList) {
//                foreach ($fileList as $currentPath => $filename) {
//
//                    //Read all file data and insert
//                    try {
//                        $readCurrent = $path . DS . $filename;
//                        if (!is_file($readCurrent)) {
//                            continue;
//                        }
//                        //$fileInfo = pathinfo($v);$fileInfo['extension']
//                        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
//                        if ('csv' == $fileExtension) {
//                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
//                        } else {
//                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//                        }
//
//                        //$this->out("PersonalInfo:: read current file name :: " . $readCurrent);
//                        //Log::debug("PersonalInfo:: read current file name :: " . $readCurrent);
//
//
//                        $this->ActivityLogs->logInfo("PersonalInfo", "read current file name", str_replace(DS, DS . DS, $readCurrent));
//
//                        $spreadsheet = $reader->load($readCurrent);
//
//                        //var_dump($spreadsheet);
//                        //Get for sheet count
////                        $sheetCount = $spreadsheet->getSheetCount();
////                        $sheetNames = $spreadsheet->getSheetNames();
////                        Log::debug("Read Excel:: sheet count:: " . $sheetCount);
////                        Log::debug("Read Excel:: sheet count:: " . json_encode($sheetNames));
//                        // Get the second sheet in the workbook
//                        // Note that sheets are indexed from 0
//                        //$spreadsheet->getSheet(1);
//                        //Get data from the active sheet
////                $sheetData = $spreadsheet->getActiveSheet()->toArray();
//                        //Get sheet by sheet name
//
//
//                        $sheetData = $spreadsheet->getSheetByName("ข้อมูลพื้นฐาน")->toArray();
//                        $spreadsheet->disconnectWorksheets();
//                        foreach ($sheetData as $k => $v) {
//                            if ($k < $this->dataRows) {
//                                continue;
//                            }
//
//                            if (empty(array_filter($v))) {
//                                continue;
//                            }
//
//                            $v = $this->trimAllData($v);
//
//                            $data = [];
//                            $this->CUSTOMER_REF = $data['card_no'] = $v[0];
//                            $data['ref_no'] = $v[1];
//                            $data['name_prefix'] = $v[2];
//                            $data['first_name'] = $v[3];
//                            $data['last_name'] = $v[4];
//                            $data['gender'] = $v[5];
//                            $data['date_of_birth'] = $v[6];
//                            $data['marital_status'] = $v[7];
//                            $data['blood_group'] = $v[8];
//                            $data['physical_status'] = $v[9];
//                            $data['issue_date'] = $v[10];
//                            $data['start_date'] = $v[11];
//                            $data['school'] = $v[12];
//                            $data['position_no'] = $v[13];
//                            $data['position_name'] = $v[14];
//                            $data['position_level'] = $v[15];
//                            $data['phone_no'] = $v[16];
//                            $data['father_name_prefix'] = $v[17];
//                            $data['father_first_name'] = $v[18];
//                            $data['father_last_name'] = $v[19];
//                            $data['mother_name_prefix'] = $v[20];
//                            $data['mother_first_name'] = $v[21];
//                            $data['mother_last_name'] = $v[22];
//                            $data['spouse_name_prefix'] = $v[23];
//                            $data['spouse_first_name'] = $v[24];
//                            $data['spouse_last_name'] = $v[25];
//
//                            $personalInfo = $this->PersonalInfos->newEntity();
//                            $personalInfo = $this->PersonalInfos->patchEntity($personalInfo, $data);
//                            if ($this->PersonalInfos->save($personalInfo)) {
//                                $currSaveStr = $personalInfo->id . '/' . $countFiles;
//                                $this->out('SAVE SUCCESS:: save personal infomation success with id :: ' . $currSaveStr);
//                                //Log::debug("PersonalInfo:: save success:: with id :: " . $personalInfo->id);
//                                $this->ActivityLogs->logInfo('PersonalInfo', "save success with id {$currSaveStr}");
//                            } else {
//                                $this->out("SAVE FAILED:: save error:: ");
//                                $sql = $this->generateInsertSQL('personal_infos', $data);
//                                //Log::debug("PersonalInfo:: save error:: " . $sql);
//                                $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, 'insert_personal_infos_error.log');
//                                $this->ActivityLogs->logError('PersonalInfo', "save error", $sql);
//                            }
//                            unset($sheetData[$k]);
//                        }
//
//
////                $sheetData = $spreadsheet->getSheetByName("การลา")->toArray();
////                        Log::debug("Read Excel:: First row:: " . json_encode($sheetData[0]));
////                        Log::debug("Read Excel:: Seccond row:: " . json_encode($sheetData[1]));
//                    } catch (\Exception $ex) {
//                        $msg = json_encode($ex);
//                        //Log::error("PersonalInfo:: error exception:: " . $msg);
//                        $this->ActivityLogs->logError('PersonalInfo', "error exception", $msg);
//                        continue;
//                    }
//                }
//            }
//        }
//    }
//    /**
//     * main() method.
//     *
//     * @return bool|int|null Success or error code.
//     */
//    public function main() {
//        $timer = new PHP_Timer();
//        $timer->start();
//        $this->out('========================    PROJECT SCHOOL IMPORT    ========================');
//        $this->importSchoolData();
//        $this->out("Totoal process time\n" . $timer->resourceUsage());
//    }

    private $countSaveSuccess = 0;
    private $countSaveFailed = 0;

    /**
     * 
     * Import personal data (ข้อมูลพื้นฐาน)
     * @param type $datas by reference
     */
    private function importPersonalInfos(&$datas) {
        if (is_array($datas) && (count($datas) > 0)) {
            $data = [];
            try {

                $this->loadModel('PersonalInfos');
//                $this->loadModel('ActivityLogs');

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


                    //Log::debug("PersonalInfo:: Data" . json_encode($data));
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
                        //Log::debug("PersonalInfo:: save error:: " . $sql);
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
                Log::error("PersonalInfo:: error exception:: " . $msg);
                $this->ActivityLogs->logError('PersonalInfo', "error exception", $msg);

                $sql = $this->generateInsertSQL('personal_infos', $data);
                $this->CrazyLog->WRITE_FILE_CONTENT($this->LOG_PATH, $sql, 'insert_personal_infos_error.log');
                $this->ActivityLogs->logError('PersonalInfo', "error exception", $sql);
            }
        }
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
        rename($sourceFile, $destinationPath . pathinfo($sourceFile, PATHINFO_BASENAME));
    }

    private function moveFileSuccessQueues($sourceFile) {
        $destinationPath = str_replace('schools', 'SUCCESS-QUEUES', $sourceFile);
        return $this->moveFile($sourceFile, $destinationPath);
    }

    private function moveFileFailedQueues($sourceFile) {
        $destinationPath = str_replace('schools', 'FAILED-QUEUES', $sourceFile);
        return $this->moveFile($sourceFile, $destinationPath);
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main() {
        //$this->makePath(__DIR__ . DS . 'a/b/c/d/abc.zip');exit;
//        $this->makePath("D:\\xampp7\\htdocs\\DEMO_CAKEPHP3_CRUD\\www\\src\\Shell\\import\\schools\\2เขตดินแดง(เสร็จแล้ว)\\ผู้บริหารสนข.ดินแดง\\sarawutt.b.xlsx");
        //$this->moveFile("D:\\xampp7\\htdocs\\DEMO_CAKEPHP3_CRUD\\www\\src\\Shell\\import\\schools\\2เขตดินแดง(เสร็จแล้ว)\\ผู้บริหารสนข.ดินแดง\\sarawutt.b.xlsx");
        //exit;
        //$this->testTryNoti();exit;
//        $this->moveFile();
//        exit;
        $timer = new PHP_Timer();
        $timer->start();

        $this->out('========================    PROJECT SCHOOL IMPORT    ========================');
//        $path = dirname(__FILE__) . DS . 'import' . DS . 'schools';
        $importPath = __DIR__ . DS . 'import' . DS . 'schools';
        $file_mimes = ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $this->listAllSchoolFile($importPath);
//        $countFiles = count($this->resultFiles, true) - count($this->resultFiles);
        $this->COUNT_ALL_FILES = count($this->resultFiles, true) - count($this->resultFiles);

//        Log::debug('All fire name list:: ' . json_encode($this->resultFiles));
//        exit;
        if ($this->COUNT_ALL_FILES > 0) {

            $this->out("PersonalInfo:: read {$this->COUNT_ALL_FILES} files.");

//            Log::debug("======================      Personal Information Import     ======================");
//            Log::debug("======================      Insert into table personal_infos     ======================");
//            Log::debug("PersonalInfo:: read {$this->COUNT_ALL_FILES} files.");
//            Log::debug("PersonalInfo:: read all of {$this->COUNT_ALL_FILES} list file :: " . json_encode($this->resultFiles));
//
//            $this->ActivityLogs->logInfo();
//            foreach ($this->resultFiles as $path => $filename) {
            foreach ($this->resultFiles as $path => $fileList) {
                foreach ($fileList as $filename) {

                    //Read all file data and insert
                    $readCurrent = $path . DS . $filename;
                    try {
                        if (!is_file($readCurrent)) {
                            continue;
                        }
                        //$fileInfo = pathinfo($v);$fileInfo['extension']
                        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if ('csv' == $fileExtension) {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                        } else {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        }

                        //$this->out("PersonalInfo:: read current file name :: " . $readCurrent);
                        Log::debug("PersonalInfo:: read current file name :: " . $readCurrent);
                        $this->ActivityLogs->logInfo("Main", "read current file name", str_replace(DS, DS . DS, $readCurrent));

                        //Load Excel file
                        $spreadsheet = $reader->load($readCurrent);

                        //var_dump($spreadsheet);
                        //Get for sheet count
//                        $sheetCount = $spreadsheet->getSheetCount();
//                        $sheetNames = $spreadsheet->getSheetNames();
//                        Log::debug("Read Excel:: sheet count:: " . $sheetCount);
//                        Log::debug("Read Excel:: sheet count:: " . json_encode($sheetNames));
                        // Get the second sheet in the workbook
                        // Note that sheets are indexed from 0
                        //$spreadsheet->getSheet(1);
                        //Get data from the active sheet
//                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        //Get sheet by sheet name
                        //Import master Personal data
                        $personalInfos = @$spreadsheet->getSheetByName("ข้อมูลพื้นฐาน")->toArray();
//                        $this->importPersonalInfos($spreadsheet->getSheetByName("ข้อมูลพื้นฐาน")->toArray());
                        $this->importPersonalInfos($personalInfos);
                        $spreadsheet->disconnectWorksheets();
                        //Move file to Success when finish
                        $this->moveFileSuccessQueues($readCurrent);
                    } catch (\Exception $ex) {
                        $msg = json_encode($ex);
                        Log::error("Main:: error exception:: " . $msg);
                        $this->ActivityLogs->logError('Main', "error exception", $msg);
                        $this->moveFileFailedQueues($readCurrent);
                        continue;
                    }
                }
            }
        }

        $this->out("Totoal process time\n" . $timer->resourceUsage());
    }

}

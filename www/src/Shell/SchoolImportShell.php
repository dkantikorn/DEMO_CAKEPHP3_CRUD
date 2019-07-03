<?php

namespace App\Shell;

use Cake\Console\Shell;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Cake\Log\Log;
use App\Controller\Component\CrazyLogComponent;
use Cake\Controller\ComponentRegistry;

set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit", "-1");

/**
 * Hello shell command.
 */
class SchoolImportShell extends Shell {

    //public $components = ['CrazyLog'];
    private $resultFiles = [];
    private $lastCurrentPath = null;
    private $dataRows = 1;
    private $CrazyLog = null;
    private $LOG_PATH = null;
    private $CURRENT_PATH = null;

    public function initialize() {
        parent::initialize();
        $this->CrazyLog = new CrazyLogComponent(new ComponentRegistry(), []);
        $this->CURRENT_PATH = dirname(__FILE__);
        $this->LOG_PATH = $this->CURRENT_PATH . DS . 'logs' . DS;
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
            if (is_dir($dir . DS . $ff)) {
                $this->lastCurrentPath = $dir . DS . $ff;
                $this->listFolderFiles($this->lastCurrentPath);
            } else {

                //Filter out for tmp save excel temp file
                if (strpos($ff, '~$') !== false) {
                    Log::debug("Read Excel:: Can not to read file name:: " . $ff);
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
    public function trimAllData($data = null) {
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
        $query = "INSERT INTO $tablename (" . implode(', ', $key) . ") " . "VALUES ('" . implode("', '", $val) . "')";
        return $query;
    }

    private function importSchoolData() {
        $this->out('========================    PROJECT SCHOOL IMPORT    ========================');
        $path = dirname(__FILE__) . DS . 'import' . DS . 'schools';
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->listAllSchoolFile($path);
        $this->loadModel('PersonalInfos');
        $countFiles = count($this->resultFiles, true) - count($this->resultFiles);
        if ($countFiles > 0) {

            $this->out("PersonalInfo:: read {$countFiles} files.");

            Log::debug("======================      Personal Information Import     ======================");
            Log::debug("======================      Insert into table personal_infos     ======================");
            Log::debug("PersonalInfo:: read {$countFiles} files.");
            Log::debug("PersonalInfo:: read all of {$countFiles} list file :: " . json_encode($this->resultFiles));


//            foreach ($this->resultFiles as $path => $filename) {
            foreach ($this->resultFiles as $path => $fileList) {
                foreach ($fileList as $currentPath => $filename) {

                    //Read all file data and insert
                    try {
                        $readCurrent = $path . DS . $filename;
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

                        $this->out("PersonalInfo:: read current file name :: " . $readCurrent);
                        Log::debug("PersonalInfo:: read current file name :: " . $readCurrent);
                        $spreadsheet = $reader->load($path . DS . $filename);

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


                        $sheetData = $spreadsheet->getSheetByName("ข้อมูลพื้นฐาน")->toArray();
                        $spreadsheet->disconnectWorksheets();
                        foreach ($sheetData as $k => $v) {
                            if ($k < $this->dataRows) {
                                continue;
                            }

                            if (empty(array_filter($v))) {
                                continue;
                            }

                            $v = $this->trimAllData($v);

                            $data = [];
                            $data['card_no'] = $v[0];
                            $data['ref_no'] = $v[1];
                            $data['name_prefix'] = $v[2];
                            $data['first_name'] = $v[3];
                            $data['last_name'] = $v[4];
                            $data['gender'] = $v[5];
                            $data['date_of_birth'] = $v[6];
                            $data['marital_status'] = $v[7];
                            $data['blood_group'] = $v[8];
                            $data['physical_status'] = $v[9];
                            $data['issue_date'] = $v[10];
                            $data['start_date'] = $v[11];
                            $data['school'] = $v[12];
                            $data['position_no'] = $v[13];
                            $data['position_name'] = $v[14];
                            $data['position_level'] = $v[15];
                            $data['phone_no'] = $v[16];
                            $data['father_name_prefix'] = $v[17];
                            $data['father_first_name'] = $v[18];
                            $data['father_last_name'] = $v[19];
                            $data['mother_name_prefix'] = $v[20];
                            $data['mother_first_name'] = $v[21];
                            $data['mother_last_name'] = $v[22];
                            $data['spouse_name_prefix'] = $v[23];
                            $data['spouse_first_name'] = $v[24];
                            $data['spouse_last_name'] = $v[25];

                            $personalInfo = $this->PersonalInfos->newEntity();
                            $personalInfo = $this->PersonalInfos->patchEntity($personalInfo, $data);
                            if ($this->PersonalInfos->save($personalInfo)) {
                                $this->out('SAVE SUCCESS:: save personal infomation success with id :: ' . $personalInfo->id);
                                Log::debug("PersonalInfo:: save success:: with id :: " . $personalInfo->id);
                            } else {
                                $this->out("SAVE FAILED:: save error:: ");
                                $sql = $this->generateInsertSQL('personal_infos', $data);
                                Log::debug("PersonalInfo:: save error:: " . $sql);
                                $this->CrazyLog->WRITE_LOG($this->LOG_PATH, $sql, 'insert_personal_infos_error.log');
                            }

                            unset($sheetData[$k]);
                        }


//                $sheetData = $spreadsheet->getSheetByName("การลา")->toArray();
//                        Log::debug("Read Excel:: First row:: " . json_encode($sheetData[0]));
//                        Log::debug("Read Excel:: Seccond row:: " . json_encode($sheetData[1]));
                    } catch (\Exception $ex) {
                        Log::error("PersonalInfo:: error exception:: " . json_encode($ex));
                        continue;
                    }
                }
            }
        }
    }

    private function generateSQLInsertEx() {

        $data = array(
            'card_no' => '3100101075727',
            'ref_no' => '51276',
            'name_prefix' => 'นาง',
            'first_name' => 'สุภาพร',
            'last_name' => 'ธวัชราภรณ์',
            'gender' => 'หญิง',
            'date_of_birth' => '4/10/2510',
            'marital_status' => 'อื่นๆ',
            'blood_group' => '',
            'physical_status' => 'ปกติ',
            'issue_date' => '5/16/2551',
            'start_date' => '5/16/2551',
            'school' => 'รร. เพี้ยนพินอนุสรณ์',
            'position_no' => 'ขนง.พพ.28(บ)',
            'position_name' => 'รองผู้อำนวยการสถานศึกษา',
            'position_level' => 'คศ.3',
            'phone_no' => '[<=99999999]0-2370-1003',
            'father_name_prefix' => 'นาย',
            'father_first_name' => 'อาโก้ว',
            'father_last_name' => 'แซ่เตีย',
            'mother_name_prefix' => 'นาง',
            'mother_first_name' => 'สมจิตร',
            'mother_last_name' => 'เสริมรัฐ',
            'spouse_name_prefix' => 'นาย',
            'spouse_first_name' => 'สุพล',
            'spouse_last_name' => 'ธวัชราภรณ์',
        );


        return $this->generateInsertSQL('personal_infos', $data);
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main() {
        $this->out('========================    PROJECT SCHOOL IMPORT    ========================');
        $this->importSchoolData();

//        $sql = $this->generateSQLInsertEx();
//        $this->CrazyLog->WRITE_LOG(dirname(__FILE__) . DS . 'logs' . DS, $sql, 'personal_infos.log');
    }

}

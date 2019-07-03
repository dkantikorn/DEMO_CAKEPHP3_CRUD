<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

ini_set('max_execution_time', 0);
ini_set("memory_limit", "-1");
define("NL", "\n");
define("TB", "\t");

class CrazyLogComponent extends Component {

    private $LOG_PATH = null;
    private $LOG_FILENAME = "default_log_file_name.log";
    private $default_uid = '00000000-0000-0000-0000-000000000000';

    public function initialize(array $config) {
        parent::initialize($config);
    }

    /**
     * 
     * Set log path
     * @author  Sarawutt.b
     * @param   string of log file name
     * @since   20150425 17:05:24
     * @return  boolean of true
     */
    public function setLogPath($logpath) {
        return $this->LOG_PATH = $logpath;
    }

    /**
     * 
     * Set log file name
     * @author  Sarawutt.b
     * @param   string of log file name
     * @since   20150425 17:05:24
     * @return  boolean of true
     */
    public function setFilename($filename) {
        return $this->LOG_FILENAME = $filename;
    }

    /**
     * 
     * Set log path and log file name
     * @author  Sarawutt.b
     * @param   string of Log file path
     * @param   string of log file name
     * @since   20150425 17:05:24
     * @return  boolean of true
     */
    public function setLogFileAndPath($path, $filename) {
        $this->LOG_PATH = $path;
        $this->LOG_FILENAME = $filename;
        return true;
    }

    /**
     * 
     * Write for log file
     * @author  Sarawutt.b
     * @param   string of Log file path
     * @param   string of log content
     * @param   string of log file name
     * @param   bollen of log enter new line
     * @param   bollen of make log in debud mode
     * @since   20150425 17:05:24
     * @return  FILE LOG write on the destination
     */
    public function WRITE_LOG($path, $txt, $file_name = NULL, $new_line = TRUE, $DEBUG = FALSE, $IS_LOG = TRUE) {
        if (is_null($file_name)) {
            $file_name = $this->LOG_FILENAME;
        }

        $contents = "";
        $log_concat = NULL;
        if ($IS_LOG === TRUE) {
            $log_concat = date("Y-m-d H:i:s") . ' : ';
        }

        if (is_array($txt)) {
            $contents = $log_concat . $this->makeContentFromArray($txt, $DEBUG);
        } else {
            $contents = $log_concat . $txt;
        }

        if (!file_exists($path)) {
            if (!is_dir($path)) {
                mkdir($path, 0777, TRUE);
                chmod($path, 0777);
            }
        }

        $file_log = "{$path}{$file_name}";
        $log_file = fopen($file_log, 'a');
        $this->WRITE_LINE($contents, $new_line);
        return fwrite($log_file, $contents . (($new_line === TRUE) ? NL : ""));
    }

    /**
     * 
     * File content write  of the params content
     * @author  Sarawutt.b
     * @param   string of Log file path
     * @param   string of log content
     * @param   string of log file name
     * @param   bollen of log enter new line
     * @param   bollen of make log in debud mode
     * @since   20150507 14:05:24
     * @return  FILE LOG write on the destination
     */
    public function WRITE_FILE_CONTENT($path, $txt, $file_name) {
        $this->WRITE_LOG($path, $txt, $file_name, TRUE, FALSE, FALSE);
    }

    /**
     * 
     * Log write lone of content
     * @author  Sarawutt.b
     * @param   string of logs content line by line
     * @param   boolean of log enter new line mode default in true
     * @since   20150425 17:05:24
     * @return  boolean of true
     */
    public function WRITE_LINE($txt, $NL = TRUE) {
        echo $txt . (($NL === TRUE) ? NL : "");
        return true;
    }

    /**
     * 
     * Log content make string from Array
     * @author  Sarawutt.b
     * @param   Mix logs content
     * @param   boolean of log in debug mode
     * @since   20150425 17:05:24
     * @return  string remake content
     */
    public function makeContentFromArray($array_data, $DEBUG = FALSE) {
        if (empty($array_data)) {
            return "";
        }
        $string_data = "";
        foreach ($array_data as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $kk => $vv) {
                    if ($DEBUG === TRUE) {
                        $string_data .= $vv . NL;
                    } else {
                        $string_data .= "'$vv',";
                    }
                }
            } else {
                if ($DEBUG === TRUE) {
                    $string_data .= $v . NL;
                } else {
                    $string_data .= "'$v',";
                }
            }
        }
        return trim($string_data, ",");
    }

}

?>

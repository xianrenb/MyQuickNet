<?php

/**
 * MQNStaticFileView
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\static_file;

use com\googlecode\myquicknet\view\MQNView;

/**
 *
 */
class MQNStaticFileView extends MQNView {

    /**
     *
     * @var int
     */
    private $cacheMaxAge;

    /**
     *
     * @var string
     */
    private $staticFileName;

    /**
     *
     * @var string
     */
    private $staticFilePath;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        if (key_exists('cache_max_age', $config)) {
            $this->cacheMaxAge = (int) $config['cache_max_age'];
        } else {
            $this->cacheMaxAge = 60 * 20;
        }

        if (key_exists('static_file_path', $config)) {
            $this->staticFilePath = (string) $config['static_file_path'];
        } else {
            $this->staticFilePath = (string) MQN_BASE_PATH;
        }

        parent::__construct($config);
    }

    /**
     *
     * @param string $fileExtension
     * @return string
     */
    protected function _fileContentType($fileExtension) {
        new \String($fileExtension);

        switch ($fileExtension) {
            case 'css':
                $out = 'text/css';
                break;
            case 'doc':
                $out = 'application/msword';
                break;
            case 'exe':
                $out = 'application/octet-stream';
                break;
            case 'gif':
                $out = 'image/gif';
                break;
            case 'html':
                $out = 'text/html';
                break;
            case 'jpeg':
            case 'jpg':
                $out = 'image/jpg';
                break;
            case 'js':
                $out = 'text/javascript';
                break;
            case 'json':
                $out = 'application/json';
                break;
            case 'pdf':
                $out = 'application/pdf';
                break;
            case 'png':
                $out = 'image/png';
                break;
            case 'ppt':
                $out = 'application/vnd.ms-powerpoint';
                break;
            case 'xls':
                $out = 'application/vnd.ms-excel';
                break;
            case 'zip':
                $out = 'application/zip';
                break;
            default:
                $out = 'application/force-download';
        }

        return $out;
    }

    /**
     *
     * @return boolean
     * @throws Exception 
     */
    public function output() {
        $fileName = (string) ($this->staticFilePath . $this->staticFileName);

        if (file_exists($fileName) && is_file($fileName)) {
            $file = fopen($fileName, 'r');

            if ($file === false) {
                return false;
            }

            if (!flock($file, LOCK_SH)) {
                throw new \Exception('Could not acquire file lock.');
            }

            //critical section started

            if (!headers_sent()) {
                $eTag = '"' . md5_file($fileName) . '"';
                $modifiedTime = (int) filemtime($fileName);
                $lastModified = (string) date(DATE_RFC1123, $modifiedTime);

                if (function_exists('getallheaders')) {
                    $headers = getallheaders();
                    $headers = array_change_key_case($headers, CASE_LOWER);
                    $modified = true;

                    if (key_exists('if-none-match', $headers)) {
                        if (trim($headers['if-none-match']) === $eTag) {
                            $modified = false;
                        }
                    } else if (key_exists('if-modified-since', $headers)) {
                        if (strtotime(trim($headers['if-modified-since'])) >= $modifiedTime) {
                            $modified = false;
                        }
                    }

                    if (!$modified) {
                        header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
                        header('Status: 304 Not Modified');
                        return true;
                    }
                }

                $pathParts = pathinfo($fileName);
                $fileExtension = (string) $pathParts['extension'];
                header('ETag: ' . $eTag);
                header('Last-Modified: ' . $lastModified);
                header('Expires: ' . date(DATE_RFC1123, time() + $this->cacheMaxAge));
                header('Cache-Control: public, max-age=' . $this->cacheMaxAge);
                header('Vary: Accept-Encoding');
                header('Content-Length: ' . filesize($fileName));
                header('Content-Type: ' . $this->_fileContentType($fileExtension));
            }

            readfile($fileName);

            if (!flock($file, LOCK_UN)) {
                throw new \Exception('Could not release file lock.');
            }

            //critical section ended

            if (!fclose($file)) {
                throw new \Exception('Could not close file.');
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $fileName
     */
    public function setStaticFileName($fileName) {
        new \String($fileName);
        $this->staticFileName = (string) $fileName;
    }

    /**
     *
     * @param string $filePath
     */
    public function setStaticFilePath($filePath) {
        new \String($filePath);
        $this->staticFilePath = (string) $filePath;
    }

}

?>

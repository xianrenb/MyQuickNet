<?php

/**
 * MQNStaticFileView
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\static_file;

use com\googlecode\myquicknet\scalar\String;
use com\googlecode\myquicknet\view\MQNView;

/**
 *
 */
class MQNStaticFileView extends MQNView
{
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
    public function __construct(array $config = array())
    {
        if (array_key_exists('cache_max_age', $config)) {
            $this->cacheMaxAge = (int) $config['cache_max_age'];
        } else {
            $this->cacheMaxAge = 60 * 20;
        }

        if (array_key_exists('static_file_path', $config)) {
            $this->staticFilePath = (string) $config['static_file_path'];
        } else {
            $this->staticFilePath = (string) MQN_BASE_PATH;
        }

        parent::__construct($config);
    }

    /**
     *
     * @param  string $fileExtension
     * @return string
     */
    protected function _fileContentType($fileExtension)
    {
        new String($fileExtension);

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
     * @return array|boolean
     */
    protected function _getAllHeaders()
    {
        $headers = false;

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
        }

        return $headers;
    }

    /**
     *
     * @param string $header
     */
    protected function _header($header)
    {
        new String($header);
        header($header);
    }

    /**
     *
     * @return boolean
     */
    protected function _headersSent()
    {
        $headersSent = (bool) headers_sent();

        return $headersSent;
    }

    /**
     *
     * @return boolean
     * @throws \Exception
     */
    public function output()
    {
        $fileName = (string) ($this->staticFilePath . $this->staticFileName);

        if (file_exists($fileName) && is_file($fileName)) {
            $file = fopen($fileName, 'r');

            if ($file === false) {
                return false;
            }

            $modified = true;

            if (!flock($file, LOCK_SH)) {
                throw new \Exception('Could not acquire file lock.');
            }

            //critical section started

            if (!$this->_headersSent()) {
                $eTag = '"' . md5_file($fileName) . '"';
                $modifiedTime = (int) filemtime($fileName);
                $lastModified = (string) date(DATE_RFC1123, $modifiedTime);
                $headers = $this->_getAllHeaders();

                if ($headers !== false) {
                    $headers = array_change_key_case($headers, CASE_LOWER);

                    if (array_key_exists('if-none-match', $headers)) {
                        if (trim($headers['if-none-match']) === $eTag) {
                            $modified = false;
                        }
                    } elseif (array_key_exists('if-modified-since', $headers)) {
                        if (strtotime(trim($headers['if-modified-since'])) >= $modifiedTime) {
                            $modified = false;
                        }
                    }

                    if (!$modified) {
                        if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
                            $this->_header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
                        }

                        $this->_header('Status: 304 Not Modified');
                    }
                }

                if ($modified) {
                    $pathParts = pathinfo($fileName);
                    $fileExtension = (string) $pathParts['extension'];
                    $this->_header('ETag: ' . $eTag);
                    $this->_header('Last-Modified: ' . $lastModified);
                    $this->_header('Expires: ' . date(DATE_RFC1123, time() + $this->cacheMaxAge));
                    $this->_header('Cache-Control: public, max-age=' . $this->cacheMaxAge);
                    $this->_header('Vary: Accept-Encoding');
                    $this->_header('Content-Length: ' . filesize($fileName));
                    $this->_header('Content-Type: ' . $this->_fileContentType($fileExtension));
                }
            }

            if ($modified) {
                readfile($fileName);
            }

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
    public function setStaticFileName($fileName)
    {
        new String($fileName);
        $this->staticFileName = (string) $fileName;
    }

    /**
     *
     * @param string $filePath
     */
    public function setStaticFilePath($filePath)
    {
        new String($filePath);
        $this->staticFilePath = (string) $filePath;
    }

}

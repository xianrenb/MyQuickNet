<?php

/**
 * TestingMainController
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing;

use com\googlecode\myquicknet\testing_config\TestingMainControllerConfig;

/**
 *
 */
class TestingMainController extends TestingMainControllerConfig
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        parent::__construct($config);
    }

}

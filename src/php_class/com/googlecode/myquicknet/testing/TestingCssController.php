<?php

/**
 * TestingCssController
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing;

use com\googlecode\myquicknet\testing_config\TestingCssControllerConfig;

/**
 *
 */
class TestingCssController extends TestingCssControllerConfig
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

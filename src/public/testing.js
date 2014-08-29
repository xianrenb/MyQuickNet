/**
 * testing
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global $: false, com: false */
(function () {
    'use strict';

    $(document).ready(function () {
        var newTypeTest = new com.googlecode.myquicknet.base.NewTypeTest();
        newTypeTest.run();
        var mqnToolsTest = new com.googlecode.myquicknet.base.MQNToolsTest();
        mqnToolsTest.run();
        var mqnMvcTest = new com.googlecode.myquicknet.mvc.MQNMVCTest();
        mqnMvcTest.run();
    });
}());

/**
 * testing
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global $: false, com: false */
(function () {
    'use strict';

    $(document).ready(function () {
        var newTypeTest = new com.googlecode.myquicknet.base.NewTypeTest();
        newTypeTest._().run();
        var mqnToolsTest = new com.googlecode.myquicknet.base.MQNToolsTest();
        mqnToolsTest._().run();
        var mqnMvcTest = new com.googlecode.myquicknet.mvc.MQNMVCTest();
        mqnMvcTest._().run();
    });
}());

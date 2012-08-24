/**
 * testing
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, vars: true, browser: true */
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

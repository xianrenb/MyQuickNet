/**
 * testing
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
 */
(function () {
    'use strict';

    $(document).ready(function () {
        var newTypeTest = new NewTypeTest();
        newTypeTest._().run();
        var mqnToolsTest = new MQNToolsTest();
        mqnToolsTest._().run();
        var mqnMvcTest = new MQNMVCTest();
        mqnMvcTest._().run();
    });
}());
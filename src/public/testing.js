/**
 * testing
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
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
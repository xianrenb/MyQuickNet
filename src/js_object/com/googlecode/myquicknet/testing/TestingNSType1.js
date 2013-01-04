/**
 * TestingNSType1
 * @package MyQuickNet
 * @version 4.5
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global newType: false */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingNSType1',
        methods: {
            _: function () {
                return this;
            },
            fa: function () {
                return 'ok!';
            }
        }
    });
}());

/**
 * TestingNSType1
 * @module MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global newType: false */
/**
 * 
 * @class com.googlecode.myquicknet.testing.TestingNSType1
 * @memberof! <global>
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingNSType1',
        methods:
            /**
             * 
             * @lends com.googlecode.myquicknet.testing.TestingNSType1.prototype
             */
            {
                /**
                 * 
                 * @returns {Object}
                 */
                _: function () {
                    return this;
                },
                /**
                 * 
                 * @returns {String}
                 */
                fa: function () {
                    return 'ok!';
                }
            }
    });
}());

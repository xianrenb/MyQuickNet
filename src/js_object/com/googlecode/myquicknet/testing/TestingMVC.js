/**
 * TestingMVC
 * @module MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global base: false, com: false, newType: false */
/**
 * 
 * @class com.googlecode.myquicknet.testing.TestingMVC
 * @memberof! <global>
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingMVC',
        base: com.googlecode.myquicknet.testing_config.TestingMVCConfig,
        methods:
            /**
             * 
             * @lends com.googlecode.myquicknet.testing.TestingMVC.prototype
             */
            {
                /**
                 * 
                 * @param {Object} config
                 * @returns {Object}
                 */
                _: function (config) {
                    base.call(this, config);
                    return this;
                }
            }
    });
}());

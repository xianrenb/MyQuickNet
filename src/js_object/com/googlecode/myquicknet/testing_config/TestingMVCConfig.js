/**
 * TestingMVCConfig
 * @module MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global base: false, com: false, newType: false */
/**
 * 
 * @class com.googlecode.myquicknet.testing_config.TestingMVCConfig
 * @memberof! <global>
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing_config',
        name: 'TestingMVCConfig',
        base: com.googlecode.myquicknet.mvc.MQNMVC,
        methods:
            /**
             * 
             * @lends com.googlecode.myquicknet.testing_config.TestingMVCConfig.prototype
             */
            {
                /**
                 * 
                 * @param {Object} config
                 * @returns {Object}
                 */
                _: function (config) {
                    config = {
                        urlBase: 'http://localhost/MyQuickNet/'
                    };

                    base._.call(this, config);
                    return this;
                }
            }
    });
}());

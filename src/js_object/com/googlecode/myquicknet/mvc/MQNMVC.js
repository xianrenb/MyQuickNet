/**
 * MQNMVC
 * @module MyQuickNet
 * @version 4.7
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global my: false, newType: false */
/**
 * 
 * @class com.googlecode.myquicknet.mvc.MQNMVC
 * @memberof! <global>
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.mvc',
        name: 'MQNMVC',
        methods:
            /**
             * 
             * @lends com.googlecode.myquicknet.mvc.MQNMVC.prototype
             */
            {
                /**
                 * 
                 * @param {Object} config
                 * @returns {Object}
                 */
                _: function (config) {
                    if (config && config.urlBase) {
                        my.urlBase = config.urlBase.toString();
                    } else {
                        my.urlBase = 'http://localhost/';
                    }

                    return this;
                },
                /**
                 * 
                 * @returns {Object}
                 */
                getUrlBase: function () {
                    return my.urlBase;
                }
            }
    });
}());

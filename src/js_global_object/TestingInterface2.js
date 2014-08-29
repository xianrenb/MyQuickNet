/**
 * TestingInterface2
 * @module MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global newType: false */
/**
 * 
 * @constructor TestingInterface2
 * @global
 */
var TestingInterface2;

(function () {
    'use strict';

    newType.def({
        name: 'TestingInterface2',
        methods:
            /**
             * 
             * @lends TestingInterface2.prototype
             */
            {
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fb: function (a, b) {
                    return 0;
                },
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fc: function (a, b) {
                    return 0;
                },
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fd: function (a, b) {
                    return 0;
                }
            }
    });
}());

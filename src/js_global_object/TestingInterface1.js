/**
 * TestingInterface1
 * @module MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global newType: false */
/**
 * 
 * @constructor TestingInterface1
 * @global
 */
var TestingInterface1;

(function () {
    'use strict';

    newType.def({
        name: 'TestingInterface1',
        methods:
            /**
             * 
             * @lends TestingInterface1.prototype
             */
            {
                /**
                 * 
                 * @returns {Number}
                 */
                getA: function () {
                    return 0;
                },
                /**
                 * 
                 * @returns {Number}
                 */
                getB: function () {
                    return 0;
                },
                /**
                 * 
                 * @returns {Number}
                 */
                getS: function () {
                    return 0;
                },
                /**
                 * 
                 * @returns {Number}
                 */
                getX: function () {
                    return 0;
                }
            }
    });
}());

/**
 * TestingType1
 * @module MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global my: false, newType: false, shared: false */
/**
 * 
 * @constructor TestingType1
 * @global
 */
var TestingType1;

(function () {
    'use strict';

    newType.def({
        name: 'TestingType1',
        shared: {
            s: 1
        },
        methods:
            /**
             * 
             * @lends TestingType1.prototype
             */
            {
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Object}
                 */
                _: function (a, b) {
                    my.a = a;
                    my.b = b;
                    my.x = 2;
                    shared.s += 3;
                    return this;
                },
                /**
                 * 
                 * @protected
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                _fa: function (a, b) {
                    my.x += 4;
                    return a - b;
                },
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fb: function (a, b) {
                    return this._fa(a, b);
                },
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fc: function (a, b) {
                    my.x += 5;
                    return a - b;
                },
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fd: function (a, b) {
                    return this.fc(a, b);
                },
                /**
                 * 
                 * @returns {Number}
                 */
                getA: function () {
                    return my.a;
                },
                /**
                 * 
                 * @returns {Number}
                 */
                getB: function () {
                    return my.b;
                },
                /**
                 * 
                 * @returns {Number}
                 */
                getS: function () {
                    return shared.s;
                },
                /**
                 * 
                 * @returns {Number}
                 */
                getX: function () {
                    return my.x;
                }
            }
    });
}());

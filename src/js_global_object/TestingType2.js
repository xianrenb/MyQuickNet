/**
 * TestingType2
 * @module MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global base: false, my: false, newType: false, shared: false, TestingInterface1: false, TestingType1: false */
/**
 * 
 * @constructor TestingType2
 * @global
 * @augments TestingType1
 */
var TestingType2;

(function () {
    'use strict';

    newType.def({
        name: 'TestingType2',
        base: TestingType1,
        interfaces: [TestingInterface1],
        shared: {
            s: 6
        },
        methods:
            /**
             * 
             * @lends TestingType2.prototype
             */
            {
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Object}
                 */
                _: function (a, b) {
                    base._.call(this, b, a);
                    my.a = base.getA.call(this);
                    my.b = base.getB.call(this);
                    my.x = 7;
                    shared.s += 8;
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
                    my.x += 9;
                    return a - b;
                },
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fc: function (a, b) {
                    my.x += 10;
                    return a - b;
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
            },
        sharedMethods:
            /**
             * 
             * @namespace TestingType2.shared
             * @memberof! <global>
             * @augments TestingType1.shared
             */
            {
                /**
                 * 
                 * @memberof TestingType2.shared
                 * @protected
                 * @param {Number} a
                 * @returns {Number}
                 */
                _sfa: function (a) {
                    var result = a;
                    result += shared.s;
                    return result;
                },
                /**
                 * 
                 * @memberof TestingType2.shared
                 * @protected
                 * @returns {Number}
                 */
                _sfb: function () {
                    return 1;
                },
                /**
                 * 
                 * @memberof TestingType2.shared
                 * @param {Number} a
                 * @returns {Number}
                 */
                sfc: function (a) {
                    return this._sfa(a);
                }
            }
    });
}());

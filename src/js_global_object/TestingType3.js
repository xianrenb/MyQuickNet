/**
 * TestingType3
 * @module MyQuickNet
 * @version 4.7
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global base: false, my: false, newType: false, self: false, shared: false, TestingInterface3: false */
/**
 * 
 * @constructor TestingType3
 * @global
 * @augments TestingType2
 */
var TestingType3;

(function () {
    'use strict';

    newType.def({
        name: 'TestingType3',
        base: 'TestingType2',
        interfaces: ['TestingInterface2', TestingInterface3],
        shared: {
            s: 11
        },
        methods:
            /**
             * 
             * @lends TestingType3.prototype
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
                    my.x = 12;
                    shared.s += 13;
                    return this;
                },
                /**
                 * 
                 * @param {Number} a
                 * @param {Number} b
                 * @returns {Number}
                 */
                fc: function (a, b) {
                    my.x += 14;
                    return this._fa(a, b);
                },
                /**
                 * 
                 * @returns {Boolean}
                 */
                fe: function () {
                    return true;
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
                },
                /**
                 * 
                 * @returns {Object}
                 */
                newObj: function () {
                    var F = self;
                    var o = new F();
                    o._(1, 2);
                    return o;
                }
            },
        sharedMethods:
            /**
             * 
             * @namespace TestingType3.shared
             * @memberof! <global>
             * @augments TestingType2.shared
             */
            {
                /**
                 * 
                 * @memberof TestingType3.shared
                 * @param {Number} a
                 * @returns {Number}
                 */
                sfc: function (a) {
                    var result = base._sfa(a) + this._sfb() + shared.s;
                    return result;
                },
                /**
                 * 
                 * @memberof TestingType3.shared
                 * @returns {Object}
                 */
                sNewObj: function () {
                    var F = self;
                    var o = new F();
                    o._(1, 2);
                    return o;
                }
            }
    });
}());

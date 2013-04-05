/**
 * TestingType2
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global base: false, my: false, newType: false, shared: false, TestingInterface1: false, TestingType1: false */
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
        methods: {
            _: function (a, b) {
                base._.call(this, b, a);
                my.a = base.getA.call(this);
                my.b = base.getB.call(this);
                my.x = 7;
                shared.s += 8;
                return this;
            },
            _fa: function (a, b) {
                my.x += 9;
                return a - b;
            },
            fc: function (a, b) {
                my.x += 10;
                return a - b;
            },
            getA: function () {
                return my.a;
            },
            getB: function () {
                return my.b;
            },
            getS: function () {
                return shared.s;
            },
            getX: function () {
                return my.x;
            }
        },
        sharedMethods: {
            _sfa: function (a) {
                var result = a;
                result += shared.s;
                return result;
            },
            _sfb: function () {
                return 1;
            },
            sfc: function (a) {
                return this._sfa(a);
            }
        }
    });
}());

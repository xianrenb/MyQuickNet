/**
 * TestingType3
 * @package MyQuickNet
 * @version 4.5
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global base: false, my: false, newType: false, self: false, shared: false, TestingInterface3: false */
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
        methods: {
            _: function (a, b) {
                base._.call(this, b, a);
                my.a = base.getA.call(this);
                my.b = base.getB.call(this);
                my.x = 12;
                shared.s += 13;
                return this;
            },
            fc: function (a, b) {
                my.x += 14;
                return this._fa(a, b);
            },
            fe: function () {
                return true;
            },
            getA: function () {
                return my.a;
            },
            getB: function () {
                return my.b;
            },
            getX: function () {
                return my.x;
            },
            getS: function () {
                return shared.s;
            },
            newObj: function () {
                var F = self;
                var o = new F();
                o._(1, 2);
                return o;
            }
        },
        sharedMethods: {
            sfc: function (a) {
                var result = base._sfa(a) + this._sfb() + shared.s;
                return result;
            },
            sNewObj: function () {
                var F = self;
                var o = new F();
                o._(1, 2);
                return o;
            }
        }
    });
}());

/**
 * TestingType1
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global my: false, newType: false, shared: false */
var TestingType1;

(function () {
    'use strict';

    newType.def({
        name: 'TestingType1',
        shared: {
            s: 1
        },
        methods: {
            _: function (a, b) {
                my.a = a;
                my.b = b;
                my.x = 2;
                shared.s += 3;
                return this;
            },
            _fa: function (a, b) {
                my.x += 4;
                return a - b;
            },
            fb: function (a, b) {
                return this._fa(a, b);
            },
            fc: function (a, b) {
                my.x += 5;
                return a - b;
            },
            fd: function (a, b) {
                return this.fc(a, b);
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
        }
    });
}());

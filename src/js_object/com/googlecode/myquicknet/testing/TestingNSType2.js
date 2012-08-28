/**
 * TestingNSType2
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global _: false, com: false, newType: false, T2: false, TestingNSType1: false, TestingType2: false */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingNSType2',
        base: 'com.googlecode.myquicknet.testing.TestingNSType1',
        interfaces: ['com.googlecode.myquicknet.testing.TestingNSInterface1', com.googlecode.myquicknet.testing.TestingNSInterface2],
        imports: [['com.googlecode.myquicknet.testing.TestingNSType1'], ['com.googlecode.myquicknet.testing.TestingNSType2', 'T2'], ['com.googlecode.myquicknet.testing.TestingNSType2', 'TestingType2']],
        methods: {
            _: function () {
                return this;
            },
            fa: function () {
                return 'ok too!';
            },
            fb: function () {
                return 'ok too!';
            },
            new_TestingNSType1: function () {
                var o = new _.TestingNSType1();
                o._();
                return o;
            },
            newT2: function () {
                var o = new T2();
                o._();
                return o;
            },
            newTestingNSType1: function () {
                var o = new TestingNSType1();
                o._();
                return o;
            },
            testingTestingType2: function () {
                var o = new TestingType2();
                o._();
                return o.fa();
            }
        },
        sharedMethods: {
            snew_TestingNSType1: function () {
                var o = new _.TestingNSType1();
                o._();
                return o;
            },
            snewT2: function () {
                var o = new T2();
                o._();
                return o;
            },
            snewTestingNSType1: function () {
                var o = new TestingNSType1();
                o._();
                return o;
            },
            stestingTestingType2: function () {
                var o = new TestingType2();
                o._();
                return o.fa();
            }
        }
    });
}());

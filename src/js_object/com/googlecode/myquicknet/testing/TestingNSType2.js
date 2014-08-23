/**
 * TestingNSType2
 * @module MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global _: false, com: false, newType: false, T2: false, TestingNSType1: false, TestingType2: false */
/**
 * 
 * @class com.googlecode.myquicknet.testing.TestingNSType2
 * @memberof! <global>
 * @augments com.googlecode.myquicknet.testing.TestingNSType1
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingNSType2',
        base: 'com.googlecode.myquicknet.testing.TestingNSType1',
        interfaces: ['com.googlecode.myquicknet.testing.TestingNSInterface1', com.googlecode.myquicknet.testing.TestingNSInterface2],
        imports: [['com.googlecode.myquicknet.testing.TestingNSType1'], ['com.googlecode.myquicknet.testing.TestingNSType2', 'T2'], ['com.googlecode.myquicknet.testing.TestingNSType2', 'TestingType2']],
        methods:
            /**
             * 
             * @lends com.googlecode.myquicknet.testing.TestingNSType2.prototype
             */
            {
                /**
                 * 
                 * @returns {Object}
                 */
                _: function () {
                    return this;
                },
                /**
                 * 
                 * @returns {String}
                 */
                fa: function () {
                    return 'ok too!';
                },
                /**
                 * 
                 * @returns {String}
                 */
                fb: function () {
                    return 'ok too!';
                },
                /**
                 * 
                 * @returns {Object}
                 */
                new_TestingNSType1: function () {
                    var o = new _.TestingNSType1();
                    return o;
                },
                /**
                 * 
                 * @returns {Object}
                 */
                newT2: function () {
                    var o = new T2();
                    return o;
                },
                /**
                 * 
                 * @returns {Object}
                 */
                newTestingNSType1: function () {
                    var o = new TestingNSType1();
                    return o;
                },
                /**
                 * 
                 * @returns {String}
                 */
                testingTestingType2: function () {
                    var o = new TestingType2();
                    return o.fa().toString();
                }
            },
        sharedMethods:
            /**
             * 
             * @namespace com.googlecode.myquicknet.testing.TestingNSType2.shared
             * @memberof! <global>
             * @augments com.googlecode.myquicknet.testing.TestingNSType1.shared
             */
            {
                /**
                 * 
                 * @memberof com.googlecode.myquicknet.testing.TestingNSType2.shared
                 * @returns {Object}
                 */
                snew_TestingNSType1: function () {
                    var o = new _.TestingNSType1();
                    return o;
                },
                /**
                 * 
                 * @memberof com.googlecode.myquicknet.testing.TestingNSType2.shared
                 * @returns {Object}
                 */
                snewT2: function () {
                    var o = new T2();
                    return o;
                },
                /**
                 * 
                 * @memberof com.googlecode.myquicknet.testing.TestingNSType2.shared
                 * @returns {Object}
                 */
                snewTestingNSType1: function () {
                    var o = new TestingNSType1();
                    return o;
                },
                /**
                 * 
                 * @memberof com.googlecode.myquicknet.testing.TestingNSType2.shared
                 * @returns {String}
                 */
                stestingTestingType2: function () {
                    var o = new TestingType2();
                    return o.fa().toString();
                }
            }
    });
}());

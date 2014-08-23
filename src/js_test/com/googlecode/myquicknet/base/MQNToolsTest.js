/**
 * MQNToolsTest
 * @module MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global _: false, equal: false, module: false, newType: false, test: false */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.base',
        name: 'MQNToolsTest',
        methods: {
            _: function () {
                return this;
            },
            run: function () {
                module('MQNToolsTest');

                test('Test1', (function (_) {
                    return function () {
                        var mqnTools = new _.MQNTools();
                        equal(mqnTools.htmlspecialchars('abc', false), 'abc');
                        equal(mqnTools.htmlspecialchars('abc&abc', false), 'abc&amp;abc');
                        equal(mqnTools.htmlspecialchars('abc<abc', false), 'abc&lt;abc');
                        equal(mqnTools.htmlspecialchars('abc>abc', false), 'abc&gt;abc');
                        equal(mqnTools.htmlspecialchars('abc"abc', false), 'abc&quot;abc');
                        equal(mqnTools.htmlspecialchars('abc\'abc', false), 'abc\'abc');
                        equal(mqnTools.htmlspecialchars('abc', true), 'abc');
                        equal(mqnTools.htmlspecialchars('abc&abc', true), 'abc&amp;abc');
                        equal(mqnTools.htmlspecialchars('abc<abc', true), 'abc&lt;abc');
                        equal(mqnTools.htmlspecialchars('abc>abc', true), 'abc&gt;abc');
                        equal(mqnTools.htmlspecialchars('abc"abc', true), 'abc&quot;abc');
                        equal(mqnTools.htmlspecialchars('abc\'abc', true), 'abc&apos;abc');
                    };
                }(_)));

                test('Test2', (function (_) {
                    return function () {
                        var mqnTools = new _.MQNTools();
                        equal(mqnTools.nl2br('abc'), 'abc');
                        equal(mqnTools.nl2br("abc\r\nabc"), 'abc<br />abc');
                        equal(mqnTools.nl2br("abc\n\rabc"), 'abc<br />abc');
                        equal(mqnTools.nl2br("abc\nabc"), 'abc<br />abc');
                        equal(mqnTools.nl2br("abc\rabc"), 'abc<br />abc');
                        equal(mqnTools.nl2br('abc', false), 'abc');
                        equal(mqnTools.nl2br("abc\r\nabc", false), 'abc<br>abc');
                        equal(mqnTools.nl2br("abc\n\rabc", false), 'abc<br>abc');
                        equal(mqnTools.nl2br("abc\nabc", false), 'abc<br>abc');
                        equal(mqnTools.nl2br("abc\rabc", false), 'abc<br>abc');
                        equal(mqnTools.nl2br('abc', true), 'abc');
                        equal(mqnTools.nl2br("abc\r\nabc", true), 'abc<br />abc');
                        equal(mqnTools.nl2br("abc\n\rabc", true), 'abc<br />abc');
                        equal(mqnTools.nl2br("abc\nabc", true), 'abc<br />abc');
                        equal(mqnTools.nl2br("abc\rabc", true), 'abc<br />abc');
                    };
                }(_)));

                test('Test3', (function (_) {
                    return function () {
                        var elementA, elementB;
                        var mqnTools = new _.MQNTools();
                        mqnTools.print('MQNToolsTest-output-a', 'testing');
                        elementA = document.getElementById('MQNToolsTest-output-a');
                        elementB = document.getElementById('MQNToolsTest-output-b');
                        elementB.innerHTML += 'testing';
                        equal(elementA.innerHTML, elementB.innerHTML);
                        mqnTools.print('MQNToolsTest-output-a', "\n123");
                        elementA = document.getElementById('MQNToolsTest-output-a');
                        elementB = document.getElementById('MQNToolsTest-output-b');
                        elementB.innerHTML += '<br />123';
                        equal(elementA.innerHTML, elementB.innerHTML);
                    };
                }(_)));
            }
        }
    });
}());

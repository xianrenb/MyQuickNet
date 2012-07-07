/**
 * MQNToolsTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
var MQNToolsTest;

(function () {
    'use strict';

    newType.def({
        name: 'MQNToolsTest',
        methods: {
            _: function () {
                return this;
            },
            run: function () {
                module('MQNToolsTest');

                test('Test1', function () {
                    var elementA, elementB;
                    var mqnTools = new MQNTools();
                    mqnTools._();
                    equal(mqnTools.nl2br('abc'), 'abc');
                    equal(mqnTools.nl2br("abc\nabc"), 'abc<br />abc');
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
                });
            }
        }
    });
}());
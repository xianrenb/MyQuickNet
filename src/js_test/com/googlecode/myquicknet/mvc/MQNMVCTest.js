/**
 * MQNMVCTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
var MQNMVCTest;

(function () {
    'use strict';

    newType.def({
        name: 'MQNMVCTest',
        methods: {
            _: function () {
                return this;
            },
            callback: function (json) {
                module('MQNMVCTest');

                test(
                    'Test1',
                    function () {
                        my.a = json.a;
                        my.b = json.b;
                        my.c = json.c;
                        my.d = json.d;
                        equal(my.a, true);
                        equal(my.b, 2.2);
                        equal(my.c, 3);
                        equal(my.d, 'string');
                    }
                    );
            },
            run: function () {
                var mvc = new TestingMVC();
                mvc._();

                $.getJSON(
                    mvc.getUrlBase().toString() + 'testing/get_data.json',
                    {},
                    (function (that) {
                        return function (json) {
                            that.callback(json);
                        };
                    }(this))
                    );
            }
        }
    });
}());
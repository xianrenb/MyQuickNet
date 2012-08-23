/**
 * MQNMVCTest
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.mvc',
        name: 'MQNMVCTest',
        imports: [['com.googlecode.myquicknet.testing.TestingMVC']],
        methods: {
            _: function () {
                return this;
            },
            callback: function (json) {
                my.a = json.a;
                my.b = json.b;
                my.c = json.c;
                my.d = json.d;
                equal(my.a, true);
                equal(my.b, 2.2);
                equal(my.c, 3);
                equal(my.d, 'string');
                start();
            },
            getData: function () {
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
            },
            run: function () {
                module('MQNMVCTest');

                asyncTest(
                    'Test1',
                    (function (that) {
                        return function () {
                            expect(4);
                            that.getData();
                        };
                    }(this))
                    );
            }
        }
    });
}());

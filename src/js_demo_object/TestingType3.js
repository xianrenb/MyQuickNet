/**
 * TestingType3
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
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
            newObj: function() {
                var o = new self();
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
                var o = new self();
                o._(1, 2);
                return o;
            }
        }
    });
}());

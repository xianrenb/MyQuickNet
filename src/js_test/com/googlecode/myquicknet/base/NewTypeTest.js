/**
 * NewTypeTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
var NewTypeTest;

(function () {
    'use strict';

    newType.def({
        name: 'NewTypeTest',
        methods: {
            _: function () {
                return this;
            },
            run: function () {
                module('NewTypeTest');
                this.test1();
                this.test2();
                this.test3();
                this.test4();
                this.test5();
            },
            test1: function () {
                test('TestingNewType', function () {
                    ok(newType instanceof NewType);
                    ok(newType.isInstance(newType, NewType));
                    ok(newType.isInstance(newType, 'NewType'));
                });
            },
            test2: function () {
                test('TestingType1', function () {
                    var testingType1, testingType1a;
                    testingType1 = new TestingType1();
                    testingType1._(1, 2);
                    ok(testingType1 instanceof TestingType1);
                    ok(!(testingType1 instanceof TestingType2));
                    ok(!(testingType1 instanceof TestingType3));
                    ok(newType.isInstance(testingType1, TestingType1));
                    ok(newType.isInstance(testingType1, 'TestingType1'));
                    ok(!newType.isInstance(testingType1, TestingType2));
                    ok(!newType.isInstance(testingType1, 'TestingType2'));
                    ok(!newType.isInstance(testingType1, TestingType3));
                    ok(!newType.isInstance(testingType1, 'TestingType3'));
                    ok(!newType.isInstance(testingType1, TestingInterface1));
                    ok(!newType.isInstance(testingType1, 'TestingInterface1'));
                    ok(!newType.isInstance(testingType1, TestingInterface2));
                    ok(!newType.isInstance(testingType1, 'TestingInterface2'));
                    ok(!newType.isInstance(testingType1, TestingInterface3));
                    ok(!newType.isInstance(testingType1, 'TestingInterface3'));
                    equal(testingType1.getA(), 1);
                    equal(testingType1.getB(), 2);
                    equal(testingType1.getX(), 2);
                    equal(testingType1.getS(), 4);
                    equal(testingType1.fb(3, 4), -1);
                    equal(testingType1.getA(), 1);
                    equal(testingType1.getB(), 2);
                    equal(testingType1.getX(), 6);
                    equal(testingType1.getS(), 4);
                    equal(testingType1.fd(5, 6), -1);
                    equal(testingType1.getA(), 1);
                    equal(testingType1.getB(), 2);
                    equal(testingType1.getX(), 11);
                    equal(testingType1.getS(), 4);
                    testingType1a = new TestingType1();
                    testingType1a._(1, 2);
                    equal(testingType1a.getA(), 1);
                    equal(testingType1a.getB(), 2);
                    equal(testingType1a.getX(), 2);
                    equal(testingType1a.getS(), 7);
                    equal(testingType1a.fb(3, 4), -1);
                    equal(testingType1a.getA(), 1);
                    equal(testingType1a.getB(), 2);
                    equal(testingType1a.getX(), 6);
                    equal(testingType1a.getS(), 7);
                    equal(testingType1a.fd(5, 6), -1);
                    equal(testingType1a.getA(), 1);
                    equal(testingType1a.getB(), 2);
                    equal(testingType1a.getX(), 11);
                    equal(testingType1a.getS(), 7);
                });
            },
            test3: function () {
                test('TestingType2', function () {
                    var testingType2, testingType2a;
                    testingType2 = new TestingType2();
                    testingType2._(1, 2);
                    ok(testingType2 instanceof TestingType1);
                    ok(testingType2 instanceof TestingType2);
                    ok(!(testingType2 instanceof TestingType3));
                    ok(newType.isInstance(testingType2, TestingType1));
                    ok(newType.isInstance(testingType2, 'TestingType1'));
                    ok(newType.isInstance(testingType2, TestingType2));
                    ok(newType.isInstance(testingType2, 'TestingType2'));
                    ok(!newType.isInstance(testingType2, TestingType3));
                    ok(!newType.isInstance(testingType2, 'TestingType3'));
                    ok(newType.isInstance(testingType2, TestingInterface1));
                    ok(newType.isInstance(testingType2, 'TestingInterface1'));
                    ok(!newType.isInstance(testingType2, TestingInterface2));
                    ok(!newType.isInstance(testingType2, 'TestingInterface2'));
                    ok(!newType.isInstance(testingType2, TestingInterface3));
                    ok(!newType.isInstance(testingType2, 'TestingInterface3'));
                    equal(testingType2.getA(), 2);
                    equal(testingType2.getB(), 1);
                    equal(testingType2.getX(), 7);
                    equal(testingType2.getS(), 14);
                    equal(testingType2.fb(3, 4), -1);
                    equal(testingType2.getA(), 2);
                    equal(testingType2.getB(), 1);
                    equal(testingType2.getX(), 16);
                    equal(testingType2.getS(), 14);
                    equal(testingType2.fd(5, 6), -1);
                    equal(testingType2.getA(), 2);
                    equal(testingType2.getB(), 1);
                    equal(testingType2.getX(), 26);
                    equal(testingType2.getS(), 14);
                    testingType2a = new TestingType2();
                    testingType2a._(1, 2);
                    equal(testingType2a.getA(), 2);
                    equal(testingType2a.getB(), 1);
                    equal(testingType2a.getX(), 7);
                    equal(testingType2a.getS(), 22);
                    equal(testingType2a.fb(3, 4), -1);
                    equal(testingType2a.getA(), 2);
                    equal(testingType2a.getB(), 1);
                    equal(testingType2a.getX(), 16);
                    equal(testingType2a.getS(), 22);
                    equal(testingType2a.fd(5, 6), -1);
                    equal(testingType2a.getA(), 2);
                    equal(testingType2a.getB(), 1);
                    equal(testingType2a.getX(), 26);
                    equal(testingType2a.getS(), 22);
                });
            },
            test4: function () {
                test('TestingType3', function () {
                    var testingType3, testingType3a;
                    testingType3 = new TestingType3();
                    testingType3._(1, 2);
                    ok(testingType3 instanceof TestingType1);
                    ok(testingType3 instanceof TestingType2);
                    ok(testingType3 instanceof TestingType3);
                    ok(newType.isInstance(testingType3, TestingType1));
                    ok(newType.isInstance(testingType3, 'TestingType1'));
                    ok(newType.isInstance(testingType3, TestingType2));
                    ok(newType.isInstance(testingType3, 'TestingType2'));
                    ok(newType.isInstance(testingType3, TestingType3));
                    ok(newType.isInstance(testingType3, 'TestingType3'));
                    ok(newType.isInstance(testingType3, TestingInterface1));
                    ok(newType.isInstance(testingType3, 'TestingInterface1'));
                    ok(newType.isInstance(testingType3, TestingInterface2));
                    ok(newType.isInstance(testingType3, 'TestingInterface2'));
                    ok(newType.isInstance(testingType3, TestingInterface3));
                    ok(newType.isInstance(testingType3, 'TestingInterface3'));
                    equal(testingType3.getA(), 1);
                    equal(testingType3.getB(), 2);
                    equal(testingType3.getX(), 12);
                    equal(testingType3.getS(), 24);
                    equal(testingType3.fb(3, 4), -1);
                    equal(testingType3.getA(), 1);
                    equal(testingType3.getB(), 2);
                    equal(testingType3.getX(), 12);
                    equal(testingType3.getS(), 24);
                    equal(testingType3.fd(5, 6), -1);
                    equal(testingType3.getA(), 1);
                    equal(testingType3.getB(), 2);
                    equal(testingType3.getX(), 26);
                    equal(testingType3.getS(), 24);
                    testingType3a = new TestingType3();
                    testingType3a._(1, 2);
                    equal(testingType3a.getA(), 1);
                    equal(testingType3a.getB(), 2);
                    equal(testingType3a.getX(), 12);
                    equal(testingType3a.getS(), 37);
                    equal(testingType3a.fb(3, 4), -1);
                    equal(testingType3a.getA(), 1);
                    equal(testingType3a.getB(), 2);
                    equal(testingType3a.getX(), 12);
                    equal(testingType3a.getS(), 37);
                    equal(testingType3a.fd(5, 6), -1);
                    equal(testingType3a.getA(), 1);
                    equal(testingType3a.getB(), 2);
                    equal(testingType3a.getX(), 26);
                    equal(testingType3a.getS(), 37);
                });
            },
            test5: function () {
                test('Checking Subtypes', function () {
                    ok(TestingType2.prototype instanceof TestingType1);
                    ok(TestingType3.prototype instanceof TestingType2);
                    ok(!newType.isInstance(TestingType1.prototype, TestingInterface1));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingInterface1'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingInterface2));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingInterface2'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingInterface3));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingInterface3'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingType1));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingType1'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingType2));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingType2'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingType3));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingType3'));
                    ok(newType.isInstance(TestingType2.prototype, TestingInterface1));
                    ok(newType.isInstance(TestingType2.prototype, 'TestingInterface1'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingInterface2));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingInterface2'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingInterface3));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingInterface3'));
                    ok(newType.isInstance(TestingType2.prototype, TestingType1));
                    ok(newType.isInstance(TestingType2.prototype, 'TestingType1'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingType2));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingType2'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingType3));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingType3'));
                    ok(newType.isInstance(TestingType3.prototype, TestingInterface1));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingInterface1'));
                    ok(newType.isInstance(TestingType3.prototype, TestingInterface2));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingInterface2'));
                    ok(newType.isInstance(TestingType3.prototype, TestingInterface3));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingInterface3'));
                    ok(newType.isInstance(TestingType3.prototype, TestingType1));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingType1'));
                    ok(newType.isInstance(TestingType3.prototype, TestingType2));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingType2'));
                    ok(!newType.isInstance(TestingType3.prototype, TestingType3));
                    ok(!newType.isInstance(TestingType3.prototype, 'TestingType3'));
                });
            }
        }
    });
}());

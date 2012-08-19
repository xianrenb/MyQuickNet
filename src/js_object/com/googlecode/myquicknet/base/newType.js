/**
 * newType
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
 */
var base = {};
var my = {};
var self = {};
var shared = {};
var newType;

(function (global) {
    'use strict';

    function NewType() {
        this._NewType = {};
    }

    NewType.prototype = {};

    NewType.prototype._ = function () {
        var my = this._NewType;
        my.stack = [];
        return this;
    };

    NewType.prototype._backup = function () {
        var my = this._NewType;
        my.stack.push(global.base);
        my.stack.push(global.my);
        my.stack.push(global.self);
        my.stack.push(global.shared);
    };

    NewType.prototype._decorateMethod = function (method) {
        var my = this._NewType;
        var vBase = my.base;
        var vMethod = method;
        var vName = my.name.toString();
        var vNewType = this;
        var vShared = my.shared;

        return function () {
            var r;
            vNewType._backup();
            global.base = (vBase && vBase.prototype) ? vBase.prototype : null;
            global.my = this['_' + vName];
            global.self = global[vName];
            global.shared = vShared;
            r = vMethod.apply(this, arguments);
            vNewType._restore();
            return r;
        };
    };

    NewType.prototype._decorateSharedMethod = function (method) {
        var my = this._NewType;
        var vBase = my.base;
        var vMethod = method;
        var vName = my.name.toString();
        var vNewType = this;
        var vShared = my.shared;

        return function () {
            var r;
            vNewType._backup();
            global.base = vBase.shared || null;
            global.my = null;
            global.self = global[vName];
            global.shared = vShared;
            r = vMethod.apply(this, arguments);
            vNewType._restore();
            return r;
        };
    };

    NewType.prototype._restore = function () {
        var my = this._NewType;
        global.shared = my.stack.pop();
        global.self = my.stack.pop();
        global.my = my.stack.pop();
        global.base = my.stack.pop();
    };

    NewType.prototype.def = function (args) {
        var f, i, interfacesCount, interfaceName, methodName;
        var my = this._NewType;
        my.name = args.name.toString();

        if (typeof args.base === 'string') {
            my.base = global[args.base] || null;
        } else {
            my.base = args.base || null;
        }

        my.interfaces = args.interfaces || [];
        my.methods = args.methods || {};
        my.shared = args.shared || {};
        my.sharedMethods = args.sharedMethods || {};

        if (my.base) {
            global[my.name] = (function (vBase, vName) {
                return function () {
                    var propertyName;
                    vBase.call(this);
                    this['_' + vName] = {};

                    for (propertyName in global[vName].prototype) {
                        if ((typeof global[vName].prototype[propertyName] === 'object') && (propertyName.charAt(0) === '_')) {
                            this[propertyName] = global[vName].prototype[propertyName];
                        }
                    }
                };
            }(my.base, my.name));

            global[my.name].prototype = new (my.base)();
        } else {
            global[my.name] = (function (vName) {
                return function () {
                    var propertyName;
                    this['_' + vName] = {};

                    for (propertyName in global[vName].prototype) {
                        if ((typeof global[vName].prototype[propertyName] === 'object') && (propertyName.charAt(0) === '_')) {
                            this[propertyName] = global[vName].prototype[propertyName];
                        }
                    }
                };
            }(my.name));

            global[my.name].prototype = {};
        }

        interfacesCount = my.interfaces.length;
        interfaceName = '';

        for (i = 0; i < interfacesCount; ++i) {
            if (typeof my.interfaces[i] === 'string') {
                interfaceName = my.interfaces[i].toString();
            } else {
                interfaceName = my.interfaces[i].typeName.toString();
            }

            global[my.name].prototype['_' + interfaceName] = {};
        }

        for (methodName in my.methods) {
            if (typeof my.methods[methodName] === 'function') {
                global[my.name].prototype[methodName] = this._decorateMethod(my.methods[methodName]);
            }
        }

        if (my.base) {
            f = (function () {});
            f.prototype = my.base.shared;
            global[my.name].shared = new f();
        } else {
            global[my.name].shared = {};
        }

        for (methodName in my.sharedMethods) {
            if (typeof my.sharedMethods[methodName] === 'function') {
                global[my.name].shared[methodName] = this._decorateSharedMethod(my.sharedMethods[methodName]);
            }
        }

        global[my.name].typeName = my.name.toString();
    };

    NewType.prototype.isInstance = function (object, type) {
        var typeName = (typeof type === 'string') ? type : (type.typeName.toString());
        return object.hasOwnProperty('_' + typeName);
    };

    NewType.shared = {};
    NewType.typeName = 'NewType';
    global.NewType = NewType;
    global.newType = new NewType();
    global.newType._();
}(this));

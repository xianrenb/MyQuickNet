/**
 * newType
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
var base = {};
var my = {};
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
        my.stack.push(global.shared);
    };

    NewType.prototype._decorate = function (method) {
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
            global.shared = vShared;
            r = vMethod.apply(this, arguments);
            vNewType._restore();
            return r;
        };
    };

    NewType.prototype._restore = function () {
        var my = this._NewType;
        global.shared = my.stack.pop();
        global.my = my.stack.pop();
        global.base = my.stack.pop();
    };

    NewType.prototype.def = function (args) {
        var i, interfacesCount, interfaceName, methodName;
        var my = this._NewType;
        my.name = args.name.toString();

        if (typeof args.base === 'string') {
            my.base = global[args.base] || null;
        } else {
            my.base = args.base || null;
        }

        my.interfaces = args.interfaces || [];
        my.shared = args.shared || {};
        my.methods = args.methods || {};

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
                interfaceName = my.interfaces[i].shared.name.toString();
            }

            global[my.name].prototype['_' + interfaceName] = {};
        }

        for (methodName in my.methods) {
            if (typeof my.methods[methodName] === 'function') {
                global[my.name].prototype[methodName] = this._decorate(my.methods[methodName]);
            }
        }

        my.shared.name = my.name.toString();
        global[my.name].shared = my.shared;
    };

    NewType.prototype.isInstance = function (object, type) {
        var typeName = (typeof type === 'string') ? type : (type.shared.name.toString());
        return object.hasOwnProperty('_' + typeName);
    };

    NewType.shared = {
        name: 'NewType'
    };

    global.NewType = NewType;
    global.newType = new NewType();
    global.newType._();
}(this));

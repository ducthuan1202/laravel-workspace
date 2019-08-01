const JsEs6 = {

    /**
     * -------------------------------------------------------------
     * BLOCK UI
     * -------------------------------------------------------------
     */
    initial: () => {
        console.log('initial application with javascript ES6');

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    },
    /**
     * -------------------------------------------------------------
     * NOTIFICATIONS PLUGIN
     * -------------------------------------------------------------
     */
    notify: {
        success: (title, text) => {
            new PNotify({title, text, type: 'success', styling: 'bootstrap3'});
        },
        error: (title, text) => {
            new PNotify({title, text, type: 'error', styling: 'bootstrap3'});
        }
    },

    /**
     * -------------------------------------------------------------
     * CHECK TYPEOF VARIABLE
     * -------------------------------------------------------------
     */
    check: {
        isCall: (input, type) => {
            return Object.prototype.toString.call(input) === "[object " + type + "]"
        },
        isString: (input) => {
            return JsEs6.check.isCall(input, "String");
        },
        isObject: (input) => {
            return JsEs6.check.isCall(input, "Object");
        },
        isNumber: (input) => {
            return JsEs6.check.isCall(input, "Number");
        },
        isArray: (input) => {
            return JsEs6.check.isCall(input, "Array");
        },
        isFunction: (input) => {
            return JsEs6.check.isCall(input, "Function");
        },
        isUndefined: (input) => {
            return JsEs6.check.isCall(input, "Undefined");
        },
        isNull: (input) => {
            return JsEs6.check.isCall(input, "Null");
        },
        isBoolean: (input) => {
            return JsEs6.check.isCall(input, "Boolean");
        },
        isRegExp: (input) => {
            return JsEs6.check.isCall(input, "RegExp");
        },
        isDate: (input) => {
            return JsEs6.check.isCall(input, "Date");
        },
        isJson: (input) => {
            try {
                JSON.parse(input);
                return true;
            } catch (e) {
                return false;
            }
        },
        isEmpty: (input) => {
            const jsCheck = JsEs6.check;
            switch (true) {
                case jsCheck.isNumber(input):
                    return input === 0;
                case jsCheck.isBoolean(input):
                    return input === false;
                case jsCheck.isObject(input):
                    return Object.keys(input).length === 0;
                case jsCheck.isString(input):
                case jsCheck.isArray(input):
                    return input.length === 0;
                case jsCheck.isUndefined(input):
                case jsCheck.isNull(input):
                    return true;
                case jsCheck.isFunction(input):
                case jsCheck.isDate(input):
                case jsCheck.isRegExp(input):
                default:
                    return false;
            }
        },
        isNotEmpty: (input) => {
            return !JsEs6.check.isEmpty(input);
        },
        inArray: (haystack, needle) => {
            return !!~haystack.indexOf(needle);
        }
    },

    /**
     * -------------------------------------------------------------
     * BLOCK UI
     * -------------------------------------------------------------
     */
    ui: {
        blockUI: (options) => {
            options = $.extend(true, {}, options);
            const html = '<div class="loading-message"><img src="/backend/img/loading-spinner-grey.gif" /><span>' + (options.message ? options.message : 'LOADING...') + '</span></div>';

            if (options.target) { // element blocking
                const el = $(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }
                el.block({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            } else { // page blocking
                $.blockUI({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    css: {
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            }
        },
        unblockUI: (target) => {
            if (target) {
                $(target).unblock({
                    onUnblock: () => {
                        $(target).css('position', '');
                        $(target).css('zoom', '');
                    }
                });
            } else {
                $.unblockUI();
            }
        }
    }


};

JsEs6.initial();
/**
 * CHÚ Ý: Ở đây sử dụng chuẩn ES6 với nhiều quy mới
 */
class BaseClass {

    constructor() {
        this.msg = {
            error: {
                MSG_ERROR_ELEMENT_SHOW_ERROR_NOT_FOUND: 'khu vực hiển thị lỗi không xác định',
                MSG_ERROR_AJAX_FAIL_DEFAULT: 'Lỗi không xác định'
            }
        };

        this.divErrorId = 'ajaxErrors';
        this.clsHidden = 'd-none';

        this.init();
    }

    init() {
        console.log('init class');
    }

    activateDivError(divError, content) {

        if (divError === undefined || divError.length === 0) {
            console.log(this.msg.error.MSG_ERROR_ELEMENT_SHOW_ERROR_NOT_FOUND);
            return;
        }

        divError.html(content).removeClass(this.clsHidden);

    }

    showError(res) {
        const self = this;
        const {success = null, data = null} = res;
        const divError = $("#" + self.divErrorId);

        /** Nếu json trả về success = false */
        if (success === false) {
            self.activateDivError(divError, data);
            return;
        }

        const {message = null, errors = null} = res.responseJSON;
        let content = '<b>' + message + '</b>';

        /** Nếu lỗi là 1 object */
        if (JsEs6.check.isObject(errors)) {
            const errStr = [];

            for(let err in errors){
                if(JsEs6.check.isArray(errors[err]) && JsEs6.check.isNotEmpty(errors[err])){
                    errStr.push(errors[err][0]);
                }
            }

            if (JsEs6.check.isEmpty(errStr)) {
                self.activateDivError(divError, content);
            } else {
                self.activateDivError(divError, content + '<ul class="bt-0"><li>' + errStr.join('</li><li>') + '</li></ul>');
            }

            return;
        }

        /** Nếu lỗi là 1 string */
        if (typeof errors === 'string' || typeof message === 'string') {
            self.activateDivError(divError, content);
            return;
        }

        /** Mặc định show ra lỗi chung chung */
        self.activateDivError(divError, '<b>' + self.msg.error.MSG_ERROR_AJAX_FAIL_DEFAULT + '</b>');
    }

    callbackAjaxError(res){
        JsEs6.notify.error('Lỗi', res.data);
    }

    callbackAjaxFail(res){
        JsEs6.notify.error('Lỗi', res.responseJSON.message);
    }
}

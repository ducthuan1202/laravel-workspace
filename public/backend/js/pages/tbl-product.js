class Product {

    __construct() {
        this.loadFormUrl = '';
        this.saveFormUrl = '';
        this.divErrorId = '';
    }

    init() {
        this.initInputMask();
        this.addEvent();
    }

    activateDivError(divError, content) {

        if (divError === undefined || divError.length === 0) {
            console.log('khu vực hiển thị lỗi không xác định');
            return;
        }
        divError.html(content).removeClass('d-none');

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
        if (typeof errors === 'object') {
            const errStr = [];
            for (let err in errors) {
                errStr.push(errors[err][0]);
            }
            if (errStr.length) {
                self.activateDivError(divError, content + '<ul class="bt-0"><li>' + errStr.join('</li><li>') + '</li></ul>');
            } else {
                self.activateDivError(divError, content);
            }

            return;
        }

        /** Nếu lỗi là 1 string */
        if (typeof errors === 'string' || typeof message === 'string') {
            self.activateDivError(divError, content);
            return;
        }

        /** Mặc định show ra lỗi chung chung */
        self.activateDivError(divError, '<b>Lỗi không xác định</b>');
    }

    addEvent() {
        const self = this;

        /**
         * event click button add new
         */
        $("[data-function='loadForm']").on('click', function () {
            self.loadForm($(this).data('id'));
        });

        /**
         * event click button edit
         */
        $("#exampleModal").on('click', "[data-function='saveForm']", function () {
            $('#exampleModal .inp-currency').unmask();
            self.saveForm($("#exampleModal form").serializeArray());
        });

        /**
         * event click button destroy
         */
        $("#exampleModal").on('click', "[data-function='destroy']", function () {
            const url = $(this).data('href');
            if (url.length) {
                self.destroy(url);
            }
        });
    }

    initInputMask() {
        const options = {
            onComplete: function (cep) {
                // alert('CEP Completed!:' + cep);
            },
            onKeyPress: function (cep, event, currentField, options) {
                // console.log('A key was pressed!:', cep, ' event: ', event, 'currentField: ', currentField, ' options: ', options);
            },
            onChange: function (cep) {
                // console.log('cep changed! ', cep);
            },
            onInvalid: function (val, e, f, invalid, options) {
                // const [error] = invalid;
                // console.log ("Digit: ", error.v, " is invalid for the position: ", error.p, ". We expect something like: ", error.e);
            },
            reverse: true
        };

        $('#exampleModal .inp-currency').mask('#,##0', options);

    }

    /*
    * --------------------------------------------------------
    * LOAD FORM AND CALLBACK
    * --------------------------------------------------------
    */
    loadFormSuccess(res) {
        $("#exampleModal").html(res.data).modal('show');
        this.initInputMask();
    }

    /**
     *
     * @param res
     */
    loadFormFail(res) {
        console.log('Lỗi load form', res);
        this.initInputMask();
    }

    loadForm(id) {
        const self = this;

        $.ajax({
            url: this.loadFormUrl,
            method: 'GET',
            data: {id: id},
            success: function (response) {
                if (response.success) {
                    self.loadFormSuccess(response);
                } else {
                    self.loadFormFail(response);
                }
            }
        });
    }

    /*
    * --------------------------------------------------------
    * SAVE FORM AND CALLBACK
    * --------------------------------------------------------
    */

    saveFormSuccess(res) {
        console.log(res);
        this.initInputMask();
        window.location.reload(true);
    }

    saveFormFail(res) {
        this.showError(res);
        this.initInputMask();
    }

    saveFormError(res) {
        this.showError(res);
        this.initInputMask();
    }

    saveForm(data = {}) {
        const self = this;
        $.ajax({
            url: this.saveFormUrl,
            method: 'POST',
            data: data,
            success: function (response) {
                if (response.success) {
                    self.saveFormSuccess(response);
                } else {
                    self.saveFormFail(response);
                }
            },
            error: function (response) {
                self.saveFormError(response);
            }
        });
    }

    /*
    * --------------------------------------------------------
    * DELETE AND CALLBACK
    * --------------------------------------------------------
    */

    destroySuccess(res) {
        console.log(res);
        window.location.reload(true);
    }

    destroyFail(res) {
        this.showError(res);
    }

    destroyError(res) {
        this.showError(res);
    }

    destroy(url) {
        const self = this;
        $.ajax({
            url: url,
            method: 'DELETE',
            data: {_method: 'DELETE'},
            success: function (response) {
                if (response.success) {
                    self.destroySuccess(response);
                } else {
                    self.destroyFail(response);
                }
            },
            error: function (response) {
                self.destroyError(response);
            }
        });
    }
}

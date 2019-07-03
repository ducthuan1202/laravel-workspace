class Product {

    constructor() {
        this.loadFormUrl = '';
        this.saveFormUrl = '';
        this.urlGetData = '';
        this.divErrorId = '';
    }

    init() {
        this.initInputMask();
        this.initSelect2();
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
        $("#grid-table-data").on('click', "[data-function='loadForm']", function () {
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


        /**
         * add event click to link a paginate
         */
        $("#grid-table-data").on('click', 'a.page-link', function (event) {
            event.preventDefault();

            self.urlGetData = $(this).attr('href');
            self.getData();

            return false;
        });


        /**
         * product search form submit event
         */

        $("form[name='product-search-form']").on('submit', function(event){
            event.preventDefault();
            const dataRequest = $(this).serializeArray();
            self.getData(dataRequest);
            return false;
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

    initSelect2() {
        console.log('init select2', $('.select2'));
        $('.select2').select2({
            width: '100%',
            height: '50px',
            theme: "classic"
        });
    }

    /*
    * --------------------------------------------------------
    * LOAD FORM AND CALLBACK
    * --------------------------------------------------------
    */
    loadFormSuccess(res) {
        $("#exampleModal").html(res.data).modal('show');
        this.initInputMask();
        this.initSelect2()
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
            beforeSend: function () {
                MyApp.blockUI({
                    target: '#grid-table-data',
                    message: 'Tải dữ liệu...',
                    overlayColor: '#000'
                });
            },
            success: function (response) {
                if (response.success) {
                    self.loadFormSuccess(response);
                } else {
                    self.loadFormFail(response);
                }
                MyApp.unblockUI('#grid-table-data');
            }
        });
    }

    /*
    * --------------------------------------------------------
    * SAVE FORM AND CALLBACK
    * --------------------------------------------------------
    */

    saveFormSuccess(res) {
        this.initInputMask();
        MyApp.unblockUI('#exampleModal');
        MyApp.notifySuccess('Thành công', res.data);
        $("#exampleModal").html('').modal('hide');
        this.getData();
    }

    saveFormFail(res) {
        this.showError(res);
        this.initInputMask();
        MyApp.unblockUI('#exampleModal');
    }

    saveFormError(res) {
        this.showError(res);
        this.initInputMask();
        MyApp.unblockUI('#exampleModal');
    }

    saveForm(data = {}) {
        const self = this;

        const request = $.ajax({
            url: this.saveFormUrl,
            method: 'POST',
            data: data,
            beforeSend: function () {
                MyApp.blockUI({target: '#exampleModal'});
            }
        });

        request.done(function (res) {
            if (res.success) {
                self.saveFormSuccess(res);
            } else {
                self.saveFormFail(res);
            }
        });

        request.fail(function (res) {
            self.saveFormError(res);

        });
    }

    /*
    * --------------------------------------------------------
    * DELETE AND CALLBACK
    * --------------------------------------------------------
    */

    destroySuccess(res) {
        console.log(res);
        MyApp.notifySuccess('Thông báo', 'Xóa thành công');
        MyApp.unblockUI('#exampleModal');
        $("#exampleModal").html('').modal('hide');
        this.getData();
    }

    destroyFail(res) {
        this.showError(res);
        MyApp.notifyError('Thông báo', 'Xóa thất bại');
        MyApp.unblockUI('#exampleModal');
    }

    destroyError(res) {
        this.showError(res);
        MyApp.unblockUI('#exampleModal');
    }

    destroy(url) {
        const self = this;

        if(!confirm('Xóa dữ liệu sẽ không thể khôi phục lại?')){
            return false;
        }

        const request = $.ajax({
            url: url,
            method: 'POST',
            data: {_method: 'DELETE'},
            beforeSend: function () {
                MyApp.blockUI({target: '#exampleModal'});
            }
        });

        request.done(function (res) {
            if (res.success) {
                self.destroySuccess(res);
            } else {
                self.destroyFail(res);
            }

        });


        request.fail(function (res) {
            self.destroyError(res);
        });
    }


    /*
    * --------------------------------------------------------
    * LOAD DATA
    * --------------------------------------------------------
    */
    getData(data = {}) {

        const request = $.ajax({
            url: this.urlGetData,
            method: "GET",
            dataType: "json",
            data: data,
            beforeSend: function(){
                MyApp.blockUI({
                    target: '#grid-table-data',
                    message: 'Tải dữ liệu...',
                    overlayColor: '#000'
                });
            }
        });

        request.done(function (res) {
            if(res.success){
                $("#grid-table-data").html(res.data);
                MyApp.unblockUI('#grid-table-data');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
            MyApp.unblockUI('#grid-table-data');
        });
    }
}

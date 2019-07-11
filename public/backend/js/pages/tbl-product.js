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
        this.calcHeightTable();
        this.initMenuContext();
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

    calcHeightTable() {
        const min = 560;
        const space = 200;

        const windowHeight = $(window).height();
        let height = windowHeight - space;
        if (height < min) {
            height = min;
        }

        $('#grid-table-data').slimScroll({
            height: height + 'px',
            allowPageScroll: false,
        });
    }

    initMenuContext() {
        $.contextMenu({
            selector: '.context-menu-one',
            callback: function (key, options) {
                switch (key) {
                    case 'status':
                        pNotifySuccess('Context Menu', 'Bạn chọn trạng thái');
                        break;
                    case 'delete':
                        pNotifyError('Cảnh báo', 'Xóa dữ liệu');
                        break;
                    default:
                        pNotifySuccess('Context Menu', 'Bạn chọn ' + key);
                        break;
                }

            },
            items: {
                "edit": {name: "Chỉnh sửa", icon: "edit",},
                "copy": {name: "Copy SĐT", icon: "copy"},
                "status": {
                    name: "Chuyển trạng thái", icon: "paste",
                    items: {
                        "sttPending": {name: "Chờ duyệt"},
                        "sttProcess": {name: "Đang xử lý"},
                        "sttDone": {name: "Hoàn thành"},
                    },

                },
                "delete": {name: "Xóa", icon: "delete"},
                "sep1": "---------",
                "quit": {
                    name: "Quit", icon: function () {
                        return 'context-menu-icon context-menu-icon-quit';
                    }
                }
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

    initSelect2() {
        console.log('init select2', $('.select2'));
        $('.select2').select2({
            width: '100%',
            height: '50px',
            theme: "classic"
        });
    }

    addEvent() {
        const self = this;

        /**
         * event click a loadForm
         */
        $("[data-function='loadForm']").on('click', function () {
            self.loadForm();
        });

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

        $("form[name='product-search-form']").on('submit', function (event) {
            event.preventDefault();
            const dataRequest = $(this).serializeArray();
            self.getData(dataRequest);
            return false;
        });

        $("#grid-table-data").on('change', "form input, form select", function () {
            console.log('123');
        })
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

        const request = $.ajax({
            url: this.loadFormUrl,
            method: 'GET',
            data: {id: id},
            beforeSend: function () {
                MyApp.blockUI({target: '#arena-block-ui'});
            }
        });

        request.done(function (response) {
            MyApp.unblockUI('#arena-block-ui');

            if (response.success) {
                self.loadFormSuccess(response);
            } else {
                self.loadFormFail(response);
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

        if (!confirm('Xóa dữ liệu sẽ không thể khôi phục lại?')) {
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
            beforeSend: function () {
                MyApp.blockUI({
                    target: '#arena-block-ui',
                    message: 'Tải dữ liệu...',
                    overlayColor: '#000'
                });
            }
        });

        request.done(function (res) {
            if (res.success) {
                $("#grid-table-data").html(res.data);
                MyApp.unblockUI('#arena-block-ui');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
            MyApp.unblockUI('#arena-block-ui');
        });
    }
}

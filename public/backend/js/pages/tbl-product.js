class Product extends BaseClass {

    constructor() {
        super();
        this.loadFormUrl = '';
        this.saveFormUrl = '';
        this.urlGetData = '';
    }

    init() {
        this.initInputMask();
        this.initSelect2();
        this.addEvent();
        this.calcHeightTable();
        this.initMenuContext();
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

    }

    /*
    * --------------------------------------------------------
    * LOAD FORM AND CALLBACK
    * --------------------------------------------------------
    */

    loadForm(id) {
        const self = this;
        const blockUiTarget = '#arena-block-ui';

        /** send request **/
        const request = $.ajax({
            url: self.loadFormUrl,
            method: 'GET',
            data: {id: id},
            beforeSend: function () {
                JsEs6.ui.blockUI({target: blockUiTarget});
            }
        });

        /** request done **/
        request.done(function (res) {
            JsEs6.ui.unblockUI(blockUiTarget);
            self.initInputMask();

            if (res.success) {
                $("#exampleModal").html(res.data).modal('show');
                self.initSelect2()
            } else {
                console.log('Lỗi load form', res);
            }
        });

        /** request fail **/
        request.fail(function (res) {
            console.log('Lỗi load form', res);
        });

    }

    /*
    * --------------------------------------------------------
    * SAVE FORM AND CALLBACK
    * --------------------------------------------------------
    */

    saveForm(data = {}) {
        const self = this;
        const blockUiTarget = '#exampleModal';

        /** send request **/
        const request = $.ajax({
            url: self.saveFormUrl,
            method: 'POST',
            data: data,
            beforeSend: function () {
                JsEs6.ui.blockUI({target: blockUiTarget});
            }
        });

        /** request done **/
        request.done(function (res) {
            JsEs6.ui.unblockUI(blockUiTarget);
            self.initInputMask();

            if (res.success) {
                JsEs6.notify.success('Thành công', res.data);
                $(blockUiTarget).html('').modal('hide');
                self.getData();
            } else {
                self.showError(res);
            }
        });

        /** request fail **/
        request.fail(function (res) {
            self.showError(res);
            self.initInputMask();
            JsEs6.ui.unblockUI(blockUiTarget);
        });
    }


    /*
    * --------------------------------------------------------
    * LOAD DATA
    * --------------------------------------------------------
    */
    getData(data = {}) {

        const self = this;
        const blockUiTarget = '#arena-block-ui';

        /** send request **/
        const request = $.ajax({
            url: self.urlGetData,
            method: "GET",
            dataType: "json",
            data: data,
            beforeSend: function () {
                JsEs6.ui.blockUI({target: blockUiTarget});
            }
        });

        /** request done **/
        request.done(function (res) {
            JsEs6.ui.unblockUI(blockUiTarget);

            if (res.success) {
                $("#grid-table-data").html(res.data);
            } else {
                // code here
            }
        });

        /** request fail **/
        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
            JsEs6.ui.unblockUI(blockUiTarget);
        });
    }
}

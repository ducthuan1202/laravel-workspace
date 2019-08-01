class Role extends BaseClass {

    constructor() {
        super();

        this.loadFormUrl = '';
        this.saveFormUrl = '';
        this.urlGetData = '';

        this.urlChoosePermissions = '';
        this.urlSavePermissions = '';
    }

    init() {
        this.addEvent();
    }

    addEvent() {
        const self = this;

        /**
         * event click a loadForm
         */
        $("[data-function='loadForm']").on('click', () => {
            self.loadForm();
        });

        /**
         * event click button add new
         */
        $("#grid-table-data").on('click', "[data-function='loadForm']", (event) => {
            self.loadForm($(event.target).data('id'));
        });

        /**
         * event click button change status
         */
        $("#grid-table-data").on('change', "[data-function='changeStatus']", (event) => {
            self.changeStatus($(event.target));
        });

        /**
         * event click button edit
         */
        $("#exampleModal").on('click', "[data-function='saveForm']", () => {
            self.saveForm($("#exampleModal form").serializeArray());
        });

        /**
         * add event click to link a paginate
         */
        $("#grid-table-data").on('click', 'a.page-link', (event) => {
            event.preventDefault();

            self.urlGetData = $(event.target).attr('href');
            self.getData();

            return false;
        });


        /**
         * event click button choose permissions
         */
        $("#grid-table-data").on('click', ".btn-choose-permissions", (event) => {
            self.choosePermission($(event.target).data('id'), []);
        });

        /**
         * event click button save permissions
         */
        $("#exampleModal").on('click', ".btn-save-permissions", (event) => {
            self.savePermissions($("#exampleModal form").serializeArray());
        });


        /**
         * event click button checked all
         */
        $("#exampleModal").on('change', "#checked-all", (event) => {
            const isChecked = $(event.target).is(':checked');
            $("#exampleModal form input[type='checkbox']").prop('checked', isChecked);
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

        const request = $.ajax({
            url: self.loadFormUrl,
            method: 'GET',
            data: {id: id},
            beforeSend: () => {
                JsEs6.ui.blockUI({target: blockUiTarget});
            }
        });

        request.done((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);

            if (res.success) {
                $("#exampleModal").html(res.data).modal('show');
            } else {
                self.callbackAjaxError(res);
            }
        });

        request.fail((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);
            self.callbackAjaxFail(res);
        });

    }

    /*
    * --------------------------------------------------------
    * SAVE FORM AND CALLBACK
    * --------------------------------------------------------
    */

    saveForm(data = {}) {
        const self = this;
        const blockUiTarget = '#exampleModal .modal-dialog';

        const request = $.ajax({
            url: this.saveFormUrl,
            method: 'POST',
            data: data,
            beforeSend: () => {
                JsEs6.ui.blockUI({target: blockUiTarget});
            }
        });

        request.done((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);

            if (res.success) {
                JsEs6.notify.success('Thành công', res.data);
                $("#exampleModal").html('').modal('hide');
                self.getData();
            } else {
                self.showError(res);
                self.callbackAjaxError(res);
            }
        });

        request.fail((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);
            self.callbackAjaxFail(res);
        });
    }

    /*
    * --------------------------------------------------------
    * LOAD DATA
    * --------------------------------------------------------
    */
    getData(data = {}) {

        const self = this;
        const request = $.ajax({
            url: self.urlGetData,
            method: "GET",
            dataType: "json",
            data: data,
            beforeSend: () => {
                JsEs6.ui.blockUI({target: '#arena-block-ui'});
            }
        });

        request.done((res) => {
            JsEs6.ui.unblockUI('#arena-block-ui');

            if (res.success) {
                $("#grid-table-data").html(res.data);
            } else {
                self.callbackAjaxError(res);
            }
        });

        request.fail((res) => {
            JsEs6.ui.unblockUI('#arena-block-ui');
            self.callbackAjaxFail(res);
        });
    }


    /*
    * --------------------------------------------------------
    * LOAD DATA
    * --------------------------------------------------------
    */
    choosePermission(id, myPermissions) {
        const self = this;

        const blockUiTarget = '#arena-block-ui';

        const request = $.ajax({
            url: this.urlChoosePermissions,
            method: 'GET',
            data: {id: id, my_permissions: myPermissions},
            beforeSend: () => {
                JsEs6.ui.blockUI({target: blockUiTarget});
            }
        });

        request.done((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);

            if (res.success) {
                $("#exampleModal").html(res.data).modal('show');
            } else {
                self.callbackAjaxError(res);
            }
        });

        request.fail((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);
            self.callbackAjaxFail(res);
        });

    }

    savePermissions(data = {}) {

        const self = this;
        const blockUiTarget = '#exampleModal .modal-dialog';

        const request = $.ajax({
            url: self.urlSavePermissions,
            method: 'POST',
            data: data,
            beforeSend: () => {
                JsEs6.ui.blockUI({target: blockUiTarget});
            }
        });

        request.done((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);
            if (res.success) {
                $("#exampleModal").html('').modal('hide');
                JsEs6.notify.success('Thành công', res.data);
            } else {
                self.showError(res);
                self.callbackAjaxError(res);
            }
        });

        request.fail((res) => {
            JsEs6.ui.unblockUI(blockUiTarget);
            self.callbackAjaxFail(res);
        });
    }
}

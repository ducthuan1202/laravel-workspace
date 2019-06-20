class Product {

    __construct() {
        this.loadFormUrl = '';
        this.saveFormUrl = '';
    }

    /*
    * --------------------------------------------------------
    * LOAD FORM AND CALLBACK
    * --------------------------------------------------------
    */
    loadFormSuccess(res) {
        $("#exampleModal").html(res.data).modal('show');
    }

    loadFormFail(res) {
        alert('loi roi', res);
    }

    loadForm(data = {}) {
        const self = this;

        $.ajax({
            url: this.loadFormUrl,
            method: 'GET',
            datatype: 'JSON',
            data: data,
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
        $("#exampleModal").html('').modal('hide');
        $('table#gridDataTable tbody').append(res.data);
    }

    saveFormFail(res) {
        console.log(res);
    }

    saveFormError(res) {
        const message = res.responseJSON.message;
        const errors = res.responseJSON.errors;
        const errStr = [];
        for (let err in errors) {
            errStr.push(errors[err][0]);
        }
        $("#ajaxErrors").html('<b>' + message + '</b><ul class="bt-0"><li>' + errStr.join('</li><li>') + '</li></ul>')
            .removeClass('d-none');
    }

    saveForm(data = {}) {
        const self = this;

        $.ajax({
            url: this.saveFormUrl,
            method: 'POST',
            datatype: 'JSON',
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
}

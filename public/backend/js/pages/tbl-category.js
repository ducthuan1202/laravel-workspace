class Category {

    constructor() {
        this.urlGetData = '';
        this.init();
    }

    init() {
        const self = this;

        $("#grid-table-data").on('click', 'a.page-link', function (event) {
            event.preventDefault();

            self.urlGetData = $(this).attr('href');
            self.getData();

            return false;
        });
    }

    getData() {

        const request = $.ajax({
            url: this.urlGetData,
            method: "GET",
            dataType: "json",
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

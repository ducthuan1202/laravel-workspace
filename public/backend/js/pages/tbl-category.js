class Category {

    constructor() {
        this.preload = '';
        this.urlGetData = '';
        this.init();
        console.log('init')
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
        const self = this;

        const request = $.ajax({
            url: this.urlGetData,
            method: "GET",
            dataType: "json",
            beforeSend: function(){
                $("#grid-table-data").html(self.preload);
            }
        });

        request.done(function (res) {
            if(res.success){
                $("#grid-table-data").html(res.data);
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    }


}

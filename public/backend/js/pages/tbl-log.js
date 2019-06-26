class Log {

    init() {
        this.initDateRangePicker();
    }

    initDateRangePicker() {


        const configs = {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                format: 'DD-MM-YYYY'
            }
        };

        function cb(start, end) {
            console.log('thực hiện gán giá trị vào 1 element nào đó')
            // $('.drp ~.input-group-append button').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('.drp').daterangepicker(configs, cb);

        $('.drp').on('apply.daterangepicker', function(ev, picker) {
            console.log(picker.startDate.format('YYYY-MM-DD'));
            console.log(picker.endDate.format('YYYY-MM-DD'));
            document.searchForm.submit();
        });
    }

}

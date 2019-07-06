class DemoGoogleChart {

    constructor() {
        this.init();
    }

    init() {
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(this.pie);
    }

    pie() {
        const data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        const options = {
            title: 'Tỉ lệ nguồn hàng'
        };

        const chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
}

new DemoGoogleChart();

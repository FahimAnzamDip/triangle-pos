$(document).ready(function () {
    let salesPurchasesBar = document.getElementById('salesPurchasesChart');
    $.get('/sales-purchases/chart-data', function (response) {
        let salesPurchasesChart = new Chart(salesPurchasesBar, {
            type: 'bar',
            data: {
                labels: response.sales.original.days,
                datasets: [{
                    label: 'Sales',
                    data: response.sales.original.data,
                    backgroundColor: [
                        '#6366F1',
                    ],
                    borderColor: [
                        '#6366F1',
                    ],
                    borderWidth: 1
                },
                    {
                        label: 'Purchases',
                        data: response.purchases.original.data,
                        backgroundColor: [
                            '#A5B4FC',
                        ],
                        borderColor: [
                            '#A5B4FC',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    let overviewChart = document.getElementById('currentMonthChart');
    $.get('/current-month/chart-data', function (response) {
        let currentMonthChart = new Chart(overviewChart, {
            type: 'doughnut',
            data: {
                labels: ['Sales', 'Purchases', 'Expenses'],
                datasets: [{
                    data: [response.sales, response.purchases, response.expenses],
                    backgroundColor: [
                        '#F59E0B',
                        '#0284C7',
                        '#EF4444',
                    ],
                    hoverBackgroundColor: [
                        '#F59E0B',
                        '#0284C7',
                        '#EF4444',
                    ],
                }]
            },
        });
    });

    let paymentChart = document.getElementById('paymentChart');
    $.get('/payment-flow/chart-data', function (response) {
        let cashflowChart = new Chart(paymentChart, {
            type: 'line',
            data: {
                labels: response.months,
                datasets: [
                    {
                        label: 'Payment Sent',
                        data: response.payment_sent,
                        fill: false,
                        borderColor: '#EA580C',
                        tension: 0
                    },
                    {
                        label: 'Payment Received',
                        data: response.payment_received,
                        fill: false,
                        borderColor: '#2563EB',
                        tension: 0
                    },
                ]
            },
        });
    });
});

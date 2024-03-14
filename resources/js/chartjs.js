import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";
import axios from "axios";

axios
    .get("/chart-get")
    .then(function (response) {
        const jsonData = response.data;
        const startDate = new Date();
        startDate.setDate(startDate.getDate() - 6);
        const endDate = new Date();
        const dates = [];
        for (
            let date = startDate;
            date <= endDate;
            date.setDate(date.getDate() + 1)
        ) {
            dates.push(date.toISOString().split("T")[0]);
        }

        const data = dates.map((date) => {
            const record = jsonData.records.find((item) => item.date === date);
            return record ? record.total_minutes : 0;
        });

        const ctx = document.getElementById("myChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: dates,
                datasets: [
                    {
                        label: "学習時間",
                        data: data,
                        backgroundColor: "#36A2EB",
                        borderColor: "#36A2EB",
                        borderWidth: 1,
                    },
                ],
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                plugins: {
                        datalabels: {
                        color: 'white',
                        formatter: function (value, context) {
                            const hours = Math.floor(value / 60);
                            const mins = value % 60;
                            if (hours > 0) {
                                return `${hours}時間${mins}分`;
                            } else {
                                return `${mins}分`;
                            }
                        },
                    },
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        max: 450,
                        ticks: {
                            callback: function (value, index, values) {
                                const hours = Math.floor(value / 60);
                                const mins = value % 60;
                                if (hours > 0) {
                                    return `${hours}時間${mins}分`;
                                } else {
                                    return `${mins}分`;
                                }
                            },
                        },
                    },
                },
            },
        });

        const ctx2 = document.getElementById("pieChart").getContext("2d");
        const pieChart = new Chart(ctx2, {
            type: "pie",
            data: {
                labels: jsonData.labels,
                datasets: [
                    {
                        data: jsonData.data,
                        backgroundColor: jsonData.colors,
                    },
                ],
            },
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    datalabels: {
                        color: 'white',
                        font: {
                            size: 13,
                        },
                        formatter: function (value, context) {
                            let sum = 0;
                            jsonData.data.forEach(item => sum += Number(item));
                            const percentage = Math.round((value / sum) * 100);
                            return `${percentage}%`;
                        },
                        render: 'percentage'
                    },
                },
                responsive: true,
                title: {
                    display: true,
                    text: "科目ごとの学習時間",
                },
            },
        });
    })
    .catch(function (error) {
        // データ取得失敗時の処理
        console.error(error);
    });

import {Line} from "vue-chartjs";

export default {
    extends: Line,
    props: {
        labels: {
            type: Array
        },
        data: {
            type: Array,
        },
        fromDate: {
            type: String
        },
        toDate: {
            type: String
        }
    },
    mounted() {
        this.renderChart(
            {
                labels: this.labels,
                datasets: [
                    {
                        label: "Incomplete Task(s)",
                        data: this.data,
                        backgroundColor: "pink",
                        borderColor: "rgba(1, 116, 188, 0.50)",
                        pointBackgroundColor: "rgba(171, 71, 188, 1)"
                    }
                ]
            },
            {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: "Number of Incomplete Task at Each Minute in the Last Hour"
                        + '(' + this.fromDate + ' - ' + this.toDate + ')'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        );
    }
};

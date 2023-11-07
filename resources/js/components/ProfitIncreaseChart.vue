<template>
    <div>
        <Bar
            id="my-chart-id"
            :options="chartOptions"
            :data="chartData"
            v-if="chartData.labels.length > 0"
        />

    </div>
</template>

<script>
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
import Axios from 'axios';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

export default {
    name: 'BarChart',
    components: { Bar },
    props: {
        mealId: Number,
    },
    data() {
        return {
            chartData: {
                labels: [],
                datasets: [{
                    label: 'Percentage of sales per month',
                    data: []
                }],
            },
            chartOptions: {
                responsive: true,
            },
        };
    },
    mounted() {
        this.fetchData(this.mealId);
    },
    methods: {
        fetchData(mealId) {
            Axios.get('/api/monthly-meal-totals/' + mealId)
                .then(response => {
                    this.chartData.labels = response.data.labels;
                    this.chartData.datasets[0].data = response.data.monthlyPercentages;

                    // Emit a custom event to notify that the data is ready
                    this.$emit('data-fetched', response.data);

                })
                .catch(error => {
                    console.error('Error fetching data: ' + error);
                });
        },
    },
}
</script>

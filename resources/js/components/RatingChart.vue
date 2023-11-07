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
            averageRatingCurrentYear: 0,
            chartData: {
                labels: [],
                datasets: [{
                    label: 'Percentage of rating per month',
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
            Axios.get('/api/monthly-rating-meal/' + mealId)
                .then(response => {
                    console.log(response)
                    this.averageRatingCurrentYear = response.data.averageRatingCurrentYear;
                    this.chartData.labels = response.data.labels;
                    this.chartData.datasets[0].data = response.data.averageRatings;

                    // Emit a custom event to notify that the data is ready
                    this.$emit('rating-data-fetched', response.data);

                })
                .catch(error => {
                    console.error('Error fetching data: ' + error);
                });
        },
    },
}
</script>

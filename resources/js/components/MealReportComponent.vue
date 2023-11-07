<template>
    <div>


                        <div class="content-body" style="margin-left: 180px;">
                            <div class="invoice-container-wrap">
                                <div class="invoice-container">
                                    <main>
                                        <div class="th-invoice invoice_style7">
                                            <div class="download-inner" id="download_section">
                                                <header class="th-header header-layout4">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-md-6">
                                                            <div class="header-logo">
                                                                <h1 class="big-title">{{ meal.name }}</h1>
                                                                <p class="invoice-number"><b>@lang('admins.invoice-no'): </b>#{{ meal.id }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </header>
                                                <hr class="style1">
                                                <p class="table-title text-center"><b>Sales Report</b></p>
                                                <table class="invoice-table table-stripe4 theme-color">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('admins.inf')</th>
                                                        <th>@lang('admins.data')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Total Sales</td>
                                                        <td>{{ orderItemCount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Average rating</td>
                                                        <td>{{ averageRating }} / 5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Revenue</td>
                                                        <td>{{ totalPriceForMeal }} $</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="body-shape1">
                                                    <svg width="850" height="200" viewBox="0 0 850 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Your SVG path elements here -->
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="invoice-buttons">
                                                <a :href="downloadLink" id="download_btn" class="download_btn" download="invoice.pdf">
                                                    <!-- Your download button content here -->
                                                </a>
                                                <button class="print_btn" @click="printInvoice">
                                                    <svg width="20" height="21" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample print icon: A printer icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M14 7V2H6v5H2v9h16V7h-4zM8 18H7v-3h1v3zm3 0h-1v-3h1v3zm3 0h-1v-3h1v3zm2-5H5V8h10v5z"/>
                                                    </svg>
                                                </button>
                                                <a :href="downloadLink" id="download_btn" class="download_btn">
                                                    <svg width="25" height="19" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample download icon: A download arrow icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M8.9 15.5h1.2v-5.4h2.8L12 7.2 9.9 9.3 8.9 8.3l2.5-2.5h-.9l-4 4 1.1 1.1 2.3-2.3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>


                        <div class="content-body" style="margin-left: 180px;">
                            <div class="invoice-container-wrap">
                                <div class="invoice-container">
                                    <main>
                                        <div class="th-invoice invoice_style7">
                                            <div class="download-inner" id="download_section">
                                                <header class="th-header header-layout4">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-md-6">
                                                            <div class="header-logo">
                                                                <h1 class="big-title">{{ meal.name }}</h1>
                                                                <p class="invoice-number"><b>@lang('admins.invoice-no'): </b>#{{ meal.id }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </header>
                                                <hr class="style1">
                                                <p class="table-title text-center"><b>Percentage of sales each month in a graph</b></p>
                                                <profit-increase-chart @data-fetched="handleDataFetched" :profit-data="chartData" :meal-id="meal.id" />

                                                <div class="body-shape1">
                                                    <svg width="850" height="200" viewBox="0 0 850 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Your SVG path elements here -->
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="invoice-buttons">
                                                <button class="print_btn" @click="printInvoice">
                                                    <svg width="20" height="21" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample print icon: A printer icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M14 7V2H6v5H2v9h16V7h-4zM8 18H7v-3h1v3zm3 0h-1v-3h1v3zm3 0h-1v-3h1v3zm2-5H5V8h10v5z"/>
                                                    </svg>
                                                </button>
                                                <a :href="downloadLink" id="download_btn" class="download_btn">
                                                    <svg width="25" height="19" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample download icon: A download arrow icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M8.9 15.5h1.2v-5.4h2.8L12 7.2 9.9 9.3 8.9 8.3l2.5-2.5h-.9l-4 4 1.1 1.1 2.3-2.3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>


                        <div class="content-body" style="margin-left: 180px;">
                            <div class="invoice-container-wrap">
                                <div class="invoice-container">
                                    <main>
                                        <div class="th-invoice invoice_style7">
                                            <div class="download-inner" id="download_section">
                                                <header class="th-header header-layout4">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-md-6">
                                                            <div class="header-logo">
                                                                <h1 class="big-title">{{ meal.name }}</h1>
                                                                <p class="invoice-number"><b>@lang('admins.invoice-no'): </b>#{{ meal.id }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </header>
                                                <hr class="style1">
                                                <p class="table-title text-center"><b>Rating Report</b></p>
                                                <table class="invoice-table table-stripe4 theme-color">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Value</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Average of rating in Current Year</td>
                                                        <td>{{ averageRatingCurrentYear }} / 5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Average of rating in All Time</td>
                                                        <td>{{ averageRating }} / 5</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="invoice-table table-stripe4 theme-color">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Value</th>
                                                        <th>Comment</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="rating in meal.ratings">
                                                        <td>{{ rating.created_at }}</td>
                                                        <td>{{ rating.rating }} / 5</td>
                                                        <td>{{ rating.comment }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="body-shape1">
                                                    <svg width="850" height="200" viewBox="0 0 850 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Your SVG path elements here -->
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="invoice-buttons">
                                                <button class="print_btn" @click="printInvoice">
                                                    <svg width="20" height="21" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample print icon: A printer icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M14 7V2H6v5H2v9h16V7h-4zM8 18H7v-3h1v3zm3 0h-1v-3h1v3zm3 0h-1v-3h1v3zm2-5H5V8h10v5z"/>
                                                    </svg>
                                                </button>
                                                <a :href="downloadLink" id="download_btn" class="download_btn">
                                                    <svg width="25" height="19" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample download icon: A download arrow icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M8.9 15.5h1.2v-5.4h2.8L12 7.2 9.9 9.3 8.9 8.3l2.5-2.5h-.9l-4 4 1.1 1.1 2.3-2.3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>


                        <div class="content-body" style="margin-left: 180px;">
                            <div class="invoice-container-wrap">
                                <div class="invoice-container">
                                    <main>
                                        <div class="th-invoice invoice_style7">
                                            <div class="download-inner" id="download_section">
                                                <header class="th-header header-layout4">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-md-6">
                                                            <div class="header-logo">
                                                                <h1 class="big-title">{{ meal.name }}</h1>
                                                                <p class="invoice-number"><b>@lang('admins.invoice-no'): </b>#{{ meal.id }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </header>
                                                <hr class="style1">
                                                <p class="table-title text-center"><b>Rating Report</b></p>
                                               <rating-chart @data-fetched="handleRatingDataFetched" :rating-data="chartData" :meal-id="meal.id" />

                                                <div class="body-shape1">
                                                    <svg width="850" height="200" viewBox="0 0 850 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Your SVG path elements here -->
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="invoice-buttons">
                                                <button class="print_btn" @click="printInvoice">
                                                    <svg width="20" height="21" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample print icon: A printer icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M14 7V2H6v5H2v9h16V7h-4zM8 18H7v-3h1v3zm3 0h-1v-3h1v3zm3 0h-1v-3h1v3zm2-5H5V8h10v5z"/>
                                                    </svg>
                                                </button>
                                                <a :href="downloadLink" id="download_btn" class="download_btn">
                                                    <svg width="25" height="19" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample download icon: A download arrow icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M8.9 15.5h1.2v-5.4h2.8L12 7.2 9.9 9.3 8.9 8.3l2.5-2.5h-.9l-4 4 1.1 1.1 2.3-2.3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>


                        <div class="content-body" style="margin-left: 180px;">
                            <div class="invoice-container-wrap">
                                <div class="invoice-container">
                                    <main>
                                        <div class="th-invoice invoice_style7">
                                            <div class="download-inner" id="download_section">
                                                <header class="th-header header-layout4">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-md-6">
                                                            <div class="header-logo">
                                                                <h1 class="big-title">{{ meal.name }}</h1> <h3>${{ meal.price }}</h3>
                                                                <p class="invoice-number"><b>@lang('admins.invoice-no'): </b>#{{ meal.id }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </header>
                                                <hr class="style1">
                                                <p class="table-title text-center"><b>Inventory Report</b></p>
                                                <table class="invoice-table table-stripe4 theme-color">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Value</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Total Sales</td>
                                                        <td>{{ orderItemCount }}</td>
                                                    </tr>

                                                    <tr v-for="material in meal.raw_materials">
                                                        <td>{{ material.brand }} {{ material.name }} X {{orderItemCount}} (total sales) </td>
                                                        <td>{{  material.pivot.quantity  * orderItemCount }} {{ material.unit }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="invoice-table table-stripe4 theme-color">
                                                    <thead>
                                                    <tr>
                                                        <th>Material</th>
                                                        <th>Weight</th>
                                                        <th>Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="material in meal.raw_materials">
                                                        <td>{{ material.brand }} {{ material.name }} (Inventory)</td>
                                                        <td>{{ material.weight }} {{ material.unit }} </td>
                                                        <td>${{ material.price }} </td>
                                                    </tr>


                                                    <tr v-for="material in meal.raw_materials">
                                                        <td>{{ material.brand }} {{ material.name }} (In 1 cup)</td>
                                                        <td>{{ material.pivot.quantity }} {{ material.unit }} </td>
                                                        <td>${{ material.price / material.weight * material.pivot.quantity }}  </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="body-shape1">
                                                    <svg width="850" height="200" viewBox="0 0 850 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Your SVG path elements here -->
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="invoice-buttons">
                                                <button class="print_btn" @click="printInvoice">
                                                    <svg width="20" height="21" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample print icon: A printer icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M14 7V2H6v5H2v9h16V7h-4zM8 18H7v-3h1v3zm3 0h-1v-3h1v3zm3 0h-1v-3h1v3zm2-5H5V8h10v5z"/>
                                                    </svg>
                                                </button>
                                                <a :href="downloadLink" id="download_btn" class="download_btn">
                                                    <svg width="25" height="19" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Sample download icon: A download arrow icon or any other icon you prefer -->
                                                        <path fill="currentColor" d="M8.9 15.5h1.2v-5.4h2.8L12 7.2 9.9 9.3 8.9 8.3l2.5-2.5h-.9l-4 4 1.1 1.1 2.3-2.3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>



            </div>

</template>

<script>

import ProfitIncreaseChart from './ProfitIncreaseChart.vue';
import RatingChart from './RatingChart.vue';

export default {
    props: {
        meal: Object,
        averageRatingCurrentYear: Number,
        orderItemCount: Number,
        averageRating: Number,
        totalPriceForMeal: Number
    },
    components: {
        ProfitIncreaseChart, RatingChart
    },
    data() {
        return {
            downloadLink: '',
            chartData: null,
        };
    },
    methods: {


        handleDataFetched(data) {
            this.chartData = data;
        },
        handleRatingDataFetched(data) {
            this.chartData = data;
        },
    },

};
</script>

<?php

namespace App\Http\Controllers\admin\apis;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\providers\Meal;
use Illuminate\Http\Request;

class ReportApiController extends Controller
{
    public function getMonthlyMealTotals($id)
    {
        // Initialize an array to store monthly meal totals
        $monthlyTotals = [];

        // Fetch the meal data for the specified meal ID
        $meal = Meal::with('ratings')->find($id);

        // Loop through each month and calculate the total meals sold and percentages
        for ($month = 1; $month <= 12; $month++) {
            $totalMeals = OrderItem::whereMonth('created_at', $month)
                ->where('meal_id', $id)
                ->count();

            $totalMealsInYear = OrderItem::whereYear('created_at', 2023)
                ->where('meal_id', $id)
                ->count();

            $percentage = ($totalMeals / $totalMealsInYear) * 100;

            // Store the total and percentage in the monthlyTotals array
            $monthlyTotals[] = $totalMeals;
            $monthlyPercentages[] = round($percentage, 2);
        }

        // Define the labels for the months
        $labels = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return response()->json(['labels' => $labels, 'monthlyTotals' => $monthlyTotals, 'monthlyPercentages' => $monthlyPercentages]);
    }
    public function getMonthlyRatingMeal($id)
    {
        // Initialize an array to store monthly average ratings and percentages
        $averageRatings = [];
        $monthlyPercentages = [];

        // Fetch the meal data for the specified meal ID
        $meal = Meal::with('ratings')->find($id);

        // Get the current year
        $currentYear = date('Y');

        // Loop through each month and calculate the average rating and percentage
        for ($month = 1; $month <= 12; $month++) {
            $averageRating = Meal::leftJoin('ratings', 'meals.id', '=', 'ratings.meal_id')
                ->selectRaw('AVG(ratings.rating) as average_rating')
                ->where('meals.id', $id)
                ->whereYear('ratings.created_at', $currentYear)
                ->whereMonth('ratings.created_at', $month)
                ->first();

            // Store the average rating in the $averageRatings array
            $averageRatings[$month] = $averageRating->average_rating ?? 0;

            // Calculate the percentage based on the current year's average rating


        }

        $averageRatingCurrentYear = $meal->ratings()
            ->whereYear('created_at', $currentYear)
            ->avg('rating');

        // Define the labels for the months
        $labels = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $averageRatings = array_values($averageRatings);
        return response()->json([
            'labels' => $labels,
            'averageRatings' => $averageRatings,
            'averageRatingCurrentYear' => $averageRatingCurrentYear
        ]);
    }

    public function weeklyOrders()
    {
        $endDateCurrent = now();
        $startDateCurrent = $endDateCurrent->copy()->subDays(6);

        $endDateLast = $startDateCurrent->copy()->subDay();
        $startDateLast = $endDateLast->copy()->subDays(6);

        $dailySalesCurrent = $this->getDailySales($startDateCurrent, $endDateCurrent);
        $dailySalesLast = $this->getDailySales($startDateLast, $endDateLast);

        return response()->json(['daily_sales_current' => $dailySalesCurrent, 'daily_sales_last' => $dailySalesLast]);
    }

    private function getDailySales($startDate, $endDate)
    {
        $dailySales = [];

        for ($day = 0; $day <= 6; $day++) {
            $currentDate = $startDate->copy()->addDays($day);
            $nextDate = $currentDate->copy()->addDay();

            $dailyCount = Order::whereBetween('created_at', [$currentDate, $nextDate])->count();

            $dailySales[$currentDate->format('D')] = $dailyCount;
        }

        $dailySalesValues = array_values($dailySales);

        return $dailySalesValues;
    }
}

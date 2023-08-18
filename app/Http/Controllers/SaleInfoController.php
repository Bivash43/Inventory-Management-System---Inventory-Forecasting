<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InvoiceDetail;
use App\Models\LinearRegression;
use App\Models\Product;
use App\Models\SaleInfo;
use Illuminate\Http\Request;

class SaleInfoController extends Controller
{
    public function index()
    {
        $detail = InvoiceDetail::salesIndex();
        $detail = json_encode(($detail));

        $products = Product::all();
        $category = Category::all();
        return view('backend.statistics.index', compact('detail', 'products', 'category'));
    }

    public function predictCategory(Request $request)
    {
        $product = Category::find($request->category_id);

        $productSoldarr = SaleInfo::productSold($request->category_id);

        $productSold = json_encode(($productSoldarr));

        $y = [];
        $date = [];
        $quantity = [];
        $i = 1;

        foreach ($productSoldarr as $key => $value) {
            $date[] = $key;
            $quantity[] = $value;
            $y[] = $i;
            $i++;
        }
        $con = new SaleInfoController();
        $nextMonth = $con->dateCon($date);

        $linearRegression = new LinearRegression();
        $linearRegression->train($y, $quantity);
        $newX = [$i + 1];
        $predictedDemand = $linearRegression->predict($newX);
        $predection =
            $formattedValue = number_format($predictedDemand[0], 2);

        return view('backend.statistics.predict', compact('productSold', 'nextMonth', 'predection', 'product'));
    }

    public function predictProduct(Request $request)
    {
        $product = Product::find($request->product_id);

        $productSoldarr = SaleInfo::productSold($request->product_id);

        $productSold = json_encode(($productSoldarr));

        $y = [];
        $date = [];
        $quantity = [];
        $i = 1;

        foreach ($productSoldarr as $key => $value) {
            $date[] = $key;
            $quantity[] = $value;
            $y[] = $i;
            $i++;
        }
        $con = new SaleInfoController();
        $nextMonth = $con->dateCon($date);

        $linearRegression = new LinearRegression();
        $linearRegression->train($y, $quantity);
        $newX = [$i + 1];
        $predictedDemand = $linearRegression->predict($newX);
        $predection =
            $formattedValue = number_format($predictedDemand[0], 2);

        return view('backend.statistics.predict', compact('productSold', 'nextMonth', 'predection', 'product'));
    }

    public function dateCon($datesArray)
    {
        // Convert the month names to numeric values
        $monthMapping = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ];

        $latestDate = null;

        foreach ($datesArray as $dateString) {
            // Extract year and month name
            list($year, $monthName) = explode('/', $dateString);

            // Convert month name to numeric value
            $month = $monthMapping[$monthName];

            $date = \Carbon\Carbon::createFromDate($year, $month);

            if ($latestDate === null || $date->greaterThan($latestDate)) {
                $latestDate = $date;
            }
        }


        // Calculate the next month after the latest date
        $nextMonth = $latestDate->copy()->addMonth();

        // Format the next month as "y/m"
        return $nextMonth->format('Y/F'); // '2023/August' in this case

    }
}

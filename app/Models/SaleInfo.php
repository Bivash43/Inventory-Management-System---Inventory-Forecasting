<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function categorySold($categoryId)
    {
        $result = static::selectRaw('YEAR(sold_date) as year, MONTH(sold_date) as month, SUM(quantity) as total_sold')
            ->where('category_id', $categoryId)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $data = [];
        foreach ($result as $row) {
            $year = $row->year;
            $month = date('F', mktime(0, 0, 0, $row->month, 1)); // Convert month number to full month name
            $totalSold = $row->total_sold;

            $data["$year/$month"] = $totalSold;
        }

        return $data;
    }

    public static function productSold($productId)
    {
        $result = static::selectRaw('YEAR(sold_date) as year, MONTH(sold_date) as month, SUM(quantity) as total_sold')
            ->where('product_id', $productId)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $data = [];
        foreach ($result as $row) {
            $year = $row->year;
            $month = date('F', mktime(0, 0, 0, $row->month, 1)); // Convert month number to full month name
            $totalSold = $row->total_sold;

            $data["$year/$month"] = $totalSold;
        }

        return $data;
    }
}

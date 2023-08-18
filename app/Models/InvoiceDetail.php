<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public static function salesIndex()
    {
        $result = static::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(selling_price) as total_amount')
            ->where('status', 1)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $data = [];
        foreach ($result as $row) {
            $year = $row->year;
            $month = date('F', mktime(0, 0, 0, $row->month, 1)); // Convert month number to full month name
            $totalAmount = $row->total_amount;

            $data["$year/$month"] = $totalAmount;
        }

        return $data;
    }
}

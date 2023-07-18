<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinearRegression extends Model
{
    private $slope;
    private $intercept;

    public function train($X, $y)
    {
        $n = count($X);
        $sumX = array_sum($X);
        $sumY = array_sum($y);
        $sumXY = 0;
        $sumXSquare = 0;

        for ($i = 0; $i < $n; $i++) {
            $sumXY += $X[$i] * $y[$i];
            $sumXSquare += $X[$i] ** 2;
        }

        $meanX = $sumX / $n;
        $meanY = $sumY / $n;

        $this->slope = ($sumXY - ($n * $meanX * $meanY)) / ($sumXSquare - ($n * $meanX ** 2));
        $this->intercept = $meanY - ($this->slope * $meanX);
    }

    public function predict($X)
    {
        $predictions = [];
        foreach ($X as $x) {
            $prediction = $this->slope * $x + $this->intercept;
            $predictions[] = $prediction;
        }
        return $predictions;
    }
}

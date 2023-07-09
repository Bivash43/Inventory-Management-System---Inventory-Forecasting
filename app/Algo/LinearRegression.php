<?php

namespace App;

class LinearRegression
{
    private $coefficients;

    public function train($X, $y)
    {
        $n = count($X);

        // Calculate the coefficients using matrix operations
        $X = array_column($X, 0);
        $X = array_map(function ($x) {
            return [$x];
        }, $X);

        $X_transpose = array_map(null, ...$X);

        $X_transpose_X = [];
        foreach ($X_transpose as $row) {
            $X_transpose_X[] = array_map(function ($x) {
                return $x[0] * $x[1];
            }, $X);
        }

        $X_transpose_X_inverse = array_map(function ($row) {
            return array_map(function ($x) {
                return $x / $n;
            }, $row);
        }, $X_transpose_X);

        $y = array_map(function ($y) {
            return [$y];
        }, $y);

        $X_transpose_y = [];
        foreach ($X_transpose as $row) {
            $X_transpose_y[] = array_map(function ($x, $y) {
                return $x[0] * $y[0];
            }, $row, $y);
        }

        $coefficients = [];
        foreach ($X_transpose_X_inverse as $row) {
            $coefficients[] = array_sum($row);
        }

        $this->coefficients = $coefficients;
    }

    public function predict($X)
    {
        $predictions = [];
        foreach ($X as $x) {
            $prediction = 0;
            foreach ($this->coefficients as $index => $coefficient) {
                $prediction += $coefficient * $x[$index];
            }
            $predictions[] = $prediction;
        }
        return $predictions;
    }
}

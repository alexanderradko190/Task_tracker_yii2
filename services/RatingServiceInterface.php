<?php

namespace app\services;

interface RatingServiceInterface
{
    public function ratingCalculation ($task): string;
}
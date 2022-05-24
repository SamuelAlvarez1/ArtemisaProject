<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";

    const NUMERIC_NULLABLE = 'nullable|numeric|min:50';

    protected $fillable = [
        'id',
        'name',
        'description',
        'idUser',
        'decorationPrice',
        'entryPrice',
        'state',
        'startDate',
        'endDate',
        'image'
    ];

    public static $rules = [
        'name' => 'required|min:3|max:100|unique:events',
        'description' => 'required|min:3|max:255',
        'startDate' => 'required|date|after_or_equal:yesterday',
        'endDate' => 'required|date|after_or_equal:startDate',
        'decorationPrice' => self::NUMERIC_NULLABLE,
        'entryPrice' => self::NUMERIC_NULLABLE,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072'
    ];
    public static $rulesUpdate = [
        'name' => 'required|min:3|max:100',
        'description' => 'required|min:3|max:255',
        'startDate' => 'required|date|after_or_equal:yesterday',
        'endDate' => 'required|date|after_or_equal:startDate',
        'decorationPrice' => self::NUMERIC_NULLABLE,
        'entryPrice' => self::NUMERIC_NULLABLE,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072'
    ];

    public $timestamps = true;
}

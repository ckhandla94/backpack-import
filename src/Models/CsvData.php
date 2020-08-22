<?php
namespace BackpackImport\Models;


use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{
    protected $table = 'csv_data';
    protected $fillable = ['csv_filename', 'csv_data'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tambahkan properti yang sesuai dengan tabel 'transactions'
    protected $table = 'transactions'; // Nama tabel di database
    protected $fillable = ['column1', 'column2', 'column3']; // Sesuaikan kolom tabel
}

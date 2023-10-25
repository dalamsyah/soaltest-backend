<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiHeader extends Model
{
    use HasFactory;
    protected $fillable = ['nomortransaksi', 'jenistransaksi'];
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $primaryKey = 'id_wisata';
    public $timestamps = false;

    protected $fillable = ['kota', 'landmark', 'tarif'];
}

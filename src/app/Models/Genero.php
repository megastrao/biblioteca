<?php

namespace App\Models;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    protected $table = 'generos';
    protected $guarded = ['id'];

    public function livros()
    {
        return $this->hasMany(Livro::class, 'genero_id');
    }
}

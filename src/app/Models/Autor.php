<?php

namespace App\Models;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'autores';
    protected $guarded = ['id'];

    public function livros()
    {
        return $this->hasMany(Livro::class, 'autor_id');
    }
}

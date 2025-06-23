<?php

namespace App\Models;

use App\Models\Editora;
use App\Models\Genero;
use App\Models\Autor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    protected $table = 'livros';
    protected $guarded = ['id'];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }
    public function editora()
    {
        return $this->belongsTo(Editora::class, 'editora_id');
    }
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    }
}

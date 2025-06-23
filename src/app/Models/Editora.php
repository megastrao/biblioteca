<?php

namespace App\Models;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    use HasFactory;
    protected $table = 'editoras';
    protected $guarded = ['id'];

    public function livros()
    {
        return $this->hasMany(Livro::class, 'editora_id');
    }
}

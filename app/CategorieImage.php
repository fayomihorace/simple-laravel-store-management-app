<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geststock_categorie_images';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['lien', 'categorie'];

    public function geststock_categories()
    {
        return $this->belongsTo('App\Categorie');
    }
    
}

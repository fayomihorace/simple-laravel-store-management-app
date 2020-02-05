<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection;
    public function __construct(){
        $this->connection = session::get('geststock_database') ;
    }
    
    protected $table = 'geststock_produits';

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
    protected $fillable = ['nom', 'categorie', 'description', 'stock', 'stock_details'];

    public function geststockCategories()
    {
        return $this->belongsTo('App\Categorie');
    }
    
}

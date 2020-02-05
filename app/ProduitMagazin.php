<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;

class ProduitMagazin extends Model
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
    
    protected $table = 'geststock_produit_magazins';

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
    protected $fillable = ['produit', 'magazin', 'stock'];

    public function produits()
    {
        return $this->belongsTo('App\Produit');
    }
    public function magazins()
    {
        return $this->belongsTo('App\Magazin');
    }
    
}

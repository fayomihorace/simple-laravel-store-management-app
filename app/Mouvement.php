<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Mouvement extends Model
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
    
    protected $table = 'geststock_mouvements';

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
    protected $fillable = ['type', 'produit', 'quantite', 'magazin', 'operation', 'description'];

    public function produits()
    {
        return $this->belongsTo('App\Produit');
    }
    public function operations()
    {
        return $this->belongsTo('App\Operation');
    }
    public function magazins()
    {
        return $this->belongsTo('App\Magazin');
    }
    
}

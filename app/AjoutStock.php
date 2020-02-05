<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;

class AjoutStock extends Model
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
    
    protected $table = 'geststock_ajout_stocks';

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
    protected $fillable = ['produit', 'quantite', 'prix', 'magazin', 'fournisseur'];

    public function produits()
    {
        return $this->belongsTo('App\Produit');
    }
    public function fournisseurs()
    {
        return $this->belongsTo('App\Fournisseur');
    }
    public function magazins()
    {
        return $this->belongsTo('App\Magazin');
    }
    
}

<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
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
    
    protected $table = 'geststock_responsables';

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
    protected $fillable = ['nom', 'prenom', 'adresse', 'email', 'telephone'];

    
}

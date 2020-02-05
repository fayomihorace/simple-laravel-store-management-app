<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
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
    
    protected $table = 'geststock_operations';

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
    protected $fillable = ['reference', 'membre', 'responsable'];

    public function membres()
    {
        return $this->belongsTo('App\Membre');
    }
    public function responsables()
    {
        return $this->belongsTo('App\Responsable');
    }
    
}

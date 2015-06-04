<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * Table Database yang digunakan model
     *
     * @var string
     */
    protected $table = "roles";
    protected $fillable = ['name', 'display_name', 'description'];
}

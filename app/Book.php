<?php
  namespace App;

  use Illuminate\Database\Eloquent\Model;

  class Book extends Model {

    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'author'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
  }
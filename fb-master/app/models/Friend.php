<?php

class Friend extends Eloquent  {

	protected $table = 'friends';

	protected $fillable = ['UID', 'full_name', 'email'];

	

	
}
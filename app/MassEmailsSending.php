<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MassEmailsSending extends Model
{
	protected $table = 'mass_emails_sending';
	protected $fillable = ['emails', 'subject', 'msg', 'author_id'];
	protected $primaryKey = 'author_id';
}

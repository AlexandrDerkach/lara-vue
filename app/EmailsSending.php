<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailsSending extends Model
{
    protected $table = 'emails_sending';
    protected $fillable = ['email', 'subject', 'msg', 'author_id'];
    protected $primaryKey = 'author_id';
}

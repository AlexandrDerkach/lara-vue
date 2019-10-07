<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingleEmailsSending extends Model
{
    protected $table = 'single_emails_sending';
    protected $fillable = ['email', 'subject', 'msg', 'author_id'];
    protected $primaryKey = 'author_id';
}

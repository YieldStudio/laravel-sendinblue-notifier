<?php

namespace YieldStudio\LaravelSendinblueNotifier\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model {
    use Notifiable;
}

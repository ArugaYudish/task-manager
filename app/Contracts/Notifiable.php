<?php

namespace App\Contracts;

interface Notifiable
{
    public function notify($message);
}

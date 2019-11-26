<?php


namespace App\Models;


use App\Models\Entity\ContactEntity;

class RContactForm
{
    public function __construct(DB $DB)
    {

    }

    public function sendForm(ContactEntity $contactEntity)
    {
        //TODO: send entity to the DB;

        return true;
    }
}
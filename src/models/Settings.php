<?php declare(strict_types=1);

namespace datastone\mailchimpSync\models;

use craft\base\Model;

class Settings extends Model
{
    public $apiKey = null;
    public $listId = null;

    public function rules(): array
    {
        return [
            [['apiKey', 'listId'], 'required'],
        ];
    }
}
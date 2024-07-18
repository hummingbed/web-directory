<?php

namespace App\Helpers;

class ResponseMessages
{
    const AUTH_SUCCESS = 'Authentication successful';
    const UNPROCESSABLE_CONTENT = 'Unprocessable content';

    const VOTE_ERROR = 'Error: You do not have permission to vote one website more than once';
    const DELETE_VOTE= 'You do not have any to vote for this website';

    const ADMIN_ERROR = 'Not allowed: you do not have permission to delete this website, must be an admin';

    public static function getSuccessMessage($entity, $action = 'created'): string
    {
        return sprintf('%s %s successfully', $entity, $action);
    }

    public static function getExistWarning($entity): string
    {
        return sprintf('%s exist already', $entity);
    }

    public static function getEntityNotExistMessage($model): string
    {
        return sprintf("$model Does Not Exist");
    }

    public static function unprocessableEntityMessage($message): string
    {
        return sprintf('Invalid %s', $message);
    }
}

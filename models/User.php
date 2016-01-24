<?php
/**
 * User class file
 *
 * @license MIT
 * @author Josh Lockhart <info@joshlockhart.com>
 */


/**
 * User model class
 *
 * This is a model class generated with DavidePastore\ParisModelGenerator.
 *
 * @license MIT
 * @author Josh Lockhart <info@joshlockhart.com>
 */
class User extends \Model
{

    public static $_id_column = 'user_id';

    public static $_table = 'user';

    public static $_table_use_short_name = true;


 	public function tasks() {
        return $this->has_many('Task');
    }
}


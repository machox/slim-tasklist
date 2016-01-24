<?php
/**
 * Task class file
 *
 * @license MIT
 * @author Josh Lockhart <info@joshlockhart.com>
 */


/**
 * Task model class
 *
 * This is a model class generated with DavidePastore\ParisModelGenerator.
 *
 * @license MIT
 * @author Josh Lockhart <info@joshlockhart.com>
 */
class Task extends \Model
{

    public static $_id_column = 'task_id';

    public static $_table = 'task';

    public static $_table_use_short_name = true;


	public function user() {
        return $this->belongs_to('User');
    }
}


<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2/8/18
 * Time: 3:04 PM
 */

namespace inquid\versionhelper\exceptions;


use yii\base\Exception;

class CouldNotGetVersionException extends Exception
{
    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return 'Could not get version string (no version file and `git describe` failed)';
    }

}

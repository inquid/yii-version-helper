<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2/8/18
 * Time: 3:00 PM
 */

namespace inquid\versionhelper;


use inquid\versionhelper\exceptions\CouldNotGetVersionException;
use yii\base\Component;

class AppVersionHelper extends Component
{

    /**
     * @param $major
     * @param $minor
     * @param $patch
     * @return mixed
     */
    public function format($major, $minor, $patch)
    {
        return "{$major}.{$minor}.{$patch}";
    }

    private static function versionFilePath()
    {
        return '../config/';
    }

    private static function versionFile()
    {
        return self::versionFilePath() . 'version.v';
    }

    private static function appName()
    {
        return \Yii::$app->params['app-name'];
    }

    /**
     * Get the app's version string
     *
     * If a file <base>/version exists, its contents are trimmed and used.
     * Otherwise we get a suitable string from `git describe`.
     *
     * @throws CouldNotGetVersionException if there is no version file and `git
     * describe` fails
     * @return string Version string
     */
    public static function getVersion()
    {
        if (file_exists(self::versionFile())) {
            return trim(file_get_contents(self::versionFile()));
        }
        return 'N/A';
    }

    public static function getBuild(){
        $dir = getcwd();
        chdir(\Yii::getAlias('@app'));
        $output = shell_exec('git rev-list --count master');
        chdir($dir);
        if ($output === null) {
            throw new CouldNotGetVersionException();
        }
        return trim($output);
    }

    /**
     * Get a string identifying the app and version
     *
     * @see getVersion
     * @throws CouldNotGetVersionException if there is no version file and `git
     * describe` fails
     * @return string App name and version string
     */
    public static function getNameAndVersion()
    {
        return self::appName() . '/' . self::getVersion();
    }
}

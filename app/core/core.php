<?php
/*
 * author: Artur Paklin
 * package: core
 * class: core
 */
class Core_Core 
{	
	public static $_path;
	public static $_config_path;
	public static $_layout;
    public static $_versions;

	/*
	 * Loads Package extensions
	 */

	public function __construct()
	{
		self::$_path = realpath('app/core');
		self::$_config_path = realpath('app/core/etc');
		// Loading main functionality scripts
		// This may be improved
		include_once(__DIR__ . "/utils/xml.php");
        include_once(__DIR__ . "/utils/sql.php");
        include_once(__DIR__ . "/utils/cookie.php");
		include_once(__DIR__ . "/extension/extension.php");
		include_once(__DIR__ . "/extension/layout/autoload.php");
		include_once(__DIR__ . "/extension/layout.php");
        include_once(__DIR__ . "/extension/version.php");
		self::$_layout = new Core_Extension_Layout();
		if (file_exists(__DIR__ . "/block/abstract.php"))
		{
			include_once(__DIR__ . "/block/abstract.php");
			new Core_Block_Abstract();
		}
		$this->loadPackages();
        $this->loadExtensionVersions();
		$this->layoutAutoload();
	}
	
	/**
	 * Executes constructor which loads extensions
	 */

	public function loadPackages() 
	{
		new Core_Extension_Extension();
	}

	public function getBlock($_block_xpath) 
	{
		// version/page_header
	}
	public function layoutAutoload()
	{
		new Core_Extension_Layout_Autoload();
	}
	public function loadExtensionVersions()
    {
        $tmp = new Core_Extension_Version();
        self::$_versions = $tmp->getCollection();
    }

    /**
     * Loads Model by abbreviations
     * @param $_model_name
     * @return null
     */

    public static function getModel($_model_name)
    {
        try {
            $model = null;
            $stringArray = explode('/', $_model_name);
            if (empty($stringArray[1])) {
                throw new Exception('does not exists ' . $_model_name . ' model');
            }
            $pathAfterModel = explode('_', $stringArray[1]);
            $pathInclude = $stringArray[0] . '/' . 'model/';
            $class = ucfirst($stringArray[0]) . '_' . 'Model_';
            $pathInclude = Router::$_basePath . '/' . $pathInclude . implode('/', $pathAfterModel) . '.php';
            foreach ($pathAfterModel as $key => $value) {
                $pathAfterModel[$key] = ucfirst($value);
            }
            $class = $class . implode('_', $pathAfterModel);

            if (file_exists($pathInclude)) {
                try {
                    self::loadDepenedencyByPath($pathInclude);
                    if (class_exists($class)) {
                        $model = new $class();
                    }
                } catch (Exception $ex) {
                    var_dump($ex->getMessage());
                }

            }
        } catch (Exception $ex) {
            // error handle;
            $model = null;
        }
        return $model;
    }

    /**
     * Loads Dependency for model by Path
     * @param $_include_path
     */

    private static function loadDepenedencyByPath($_include_path)
    {
        $fp = fopen($_include_path, 'r');
        $buffer = fread($fp, filesize($_include_path));
        $extendClass = null;
        while ($buffer) {
            if (preg_match('/(extends)\s(\w+)/', $buffer, $matches)) {
                $extendClass = $matches[2];
                break;
            }
            $buffer = fread($fp, filesize($_include_path));
        }
        if (self::loadDependenyByClass($extendClass)) {
            include_once($_include_path);
        }
    }

    /**
     * Loads dependency for model by class name
     * @param $_class
     * @return bool
     */

    private static function loadDependenyByClass($_class)
    {
        $classElements = explode('_', $_class);

        foreach ($classElements as $key => $value) {
            $classElements[$key] = lcfirst($value);
        }
        $path = implode('/', $classElements);
        $path = Router::$_basePath . '/' . $path . '.php';

        $fp = fopen($path,'r');
        $buffer = fread($fp, filesize($path));
        $extendClass = null;
        while ($buffer) {
            if (preg_match('/(extends)\s(\w+)/', $buffer, $matches)) {
                $extendClass = $matches[2];
                break;
            }
            $buffer = fread($fp, filesize($path));
        }
        if ($extendClass) {
            if (self::loadDependenyByClass($extendClass)) {
                include_once($path);
                return true;
            }
        } else {
            include_once($path);
            return true;
        }
    }

}
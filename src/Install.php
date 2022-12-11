<?php

namespace think\Laradumps;

use think\App;
use think\Env;

use Composer\Script\Event;

class Install
{
	public static function config($event){
		$io = $event->getIO();
		$io->write('in install');
		$io->write('version:'.App::VERSION);
		$app = new App();
		$io->write('config_path:'.$app->getConfigPath());
		$io->write(__DIR__.'/../config/config.php');
		// 兼容tp 5.1
		if(version_compare(App::VERSION, '6.0.0')== -1){
			$config_path = $app->getConfigPath();
			$target_file = "{$config_path}/laradumps.php";
			$io->write('in copy');
			if(!file_exists($target_file)){
				copy(__DIR__.'/../config/config.php', $target_file);
			}
		}
	}

}
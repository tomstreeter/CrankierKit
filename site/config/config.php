<?php

return [
	'panel' => [
		// Set to false after installation on production
		'install' => true,
	],
	'ready' => function () {
				if (option('standby')) :
					$home_dir = 'standby';
				else :
					$home_dir = 'home';
				endif;
				return [
					'home' => $home_dir,
				];
	},
];
<?php

return [
    'debug' => true,
    'ready' => function () {
				$standby = false;
				if ($standby) :
					$home_dir = 'standby';
				else :
					$home_dir = 'home';
				endif;
				return [
					'home' => $home_dir,
				];
	},
];
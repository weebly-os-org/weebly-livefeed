<?php

return [
	'mailgun' => [
	    'domain' => getenv('MAILGUN_DOMAIN'),
	    'secret' => getenv('MAILGUN_SECRET')
	]
];
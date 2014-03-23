<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Alert Types
	|--------------------------------------------------------------------------
	|
	| The default sort of alert types which can be called as functions on the
	| Notify class. This gives a convenient way to add certain type's
	| of messages.
	|
	| For example:
	|
	|     Notify::info($message);
	|
	*/

	'types' => array(
		'info',
		'warning',
		'error',
		'success',
	),

	/*
	|--------------------------------------------------------------------------
	| Session Key
	|--------------------------------------------------------------------------
	|
	| The session key which is used to store flashed messages into the current
	| session. This can be changed if it conflicts with another key.
	|
	*/

	'session_key' => 'notify_messages',

);
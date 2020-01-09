 <?php

return [

	/* Important Settings */

	// ======================================================================
	// never remove 'web', . just put your middleware like auth or admin (if you have) here. eg: ['web','auth']
	'middlewares' => ['web'],
	// you can change default route from sms-admin to anything you want
	'route' => 'sms-admin',
	// SMS.ir Api Key
	'api-key' => env('SMSIR-API-KEY','3e422b93af36530535c02b93'),
	// SMS.ir Secret Key
	'secret-key' => env('SMSIR-SECRET-KEY','it66)%#teBC!@*&'),
	// Your sms.ir line number
	'line-number' => env('SMSIR-LINE-NUMBER','50002015649095'),
	// ======================================================================

	// set true if you want log to the database
	'db-log' => true,

	/* Admin Panel Title */
	'title' => 'مدیریت پیامک ها',
	// How many log you want to show in sms-admin panel ?
	'in-page' => '15'
];
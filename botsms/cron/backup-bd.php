<?php

include __DIR__.'/../includes/includes.php';
/*$tlg = new Telegram ('5777177877:AAHJFs4vmafwenqrYrc4rrJfRhV1Q0QuMbM');*/
$tlg = new Telegram ('5777177877:AAHJFs4vmafwenqrYrc4rrJfRhV1Q0QuMbM');
print_r ($tlg->sendDocument ([
	'chat_id' => 1003162242,
	'caption' => "Backup\n@MandrackBOT\n".date ('d/m/Y H:i:s'),
	'document' => curl_file_create (__DIR__.'/../recebersmsbot.db')
]));
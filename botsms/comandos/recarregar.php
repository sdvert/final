<?php

if ($tlg->Callback_ID () !== null){
	
	// encerra carregamento do botão de callback
	$tlg->answerCallbackQuery ([
		'callback_query_id' => $tlg->Callback_ID ()
	]);

}

$bonus = (BONUS == 0) ? '' : '<em><u>+'.BONUS.'% bônus</u></em>';
$valor_pagamento = 12;

if (isset ($complemento)){

	// pega valor e tipo de calculo
	@list ($valor, $calculo) = explode (' ', $complemento);

	switch ($calculo) {
		case "+1":

		$valor_pagamento = ++$valor;

			break;

		case "+10":

		$valor_pagamento = $valor+10;

			break;

		case "-10":

		$valor_pagamento = $valor-10;

			break;
		
		case "-1":

		$valor_pagamento = --$valor;

			break;
	}

	// checagem de valor abaixo do mínimo
	if ($valor_pagamento < 10){
		$valor_pagamento = 10;
	}

}

$dados_mensagem = [
	'chat_id' => $tlg->ChatID (),
	'text' => "Escolha um valor para recarregar:\n<b>pagamento por pix, boleto, saldo ou cartão</b>.\n\n<b>💰Valor: R$ ".number_format ($valor_pagamento, 2)." {$bonus}</b>",
	'parse_mode' => 'html',
	'message_id' => $tlg->MessageID (),
	'disable_web_page_preview' => 'true',
	'reply_markup' => $tlg->buildInlineKeyboard ([
		[
			$tlg->buildInlineKeyBoardButton ('+1', null, "/recarregar {$valor_pagamento} +1"),
			$tlg->buildInlineKeyBoardButton ('-1', null, "/recarregar {$valor_pagamento} -1")
		],
		[
			$tlg->buildInlineKeyBoardButton ('+10', null, "/recarregar {$valor_pagamento} +10"),
			$tlg->buildInlineKeyBoardButton ('-10', null, "/recarregar {$valor_pagamento} -10")
		],
		[$tlg->buildInlineKeyBoardButton ('Comprar', null, "/comprar {$valor_pagamento}")]
	])
];

if ($tlg->Callback_ID () !== null){

	$tlg->editMessageText ($dados_mensagem);

}else {

	$tlg->sendMessage ($dados_mensagem);

}
<?php

header('Content-Type: text/html; charset=UTF-8');

/*
 * consulta a dúvida e retorna os documentos que estão na base de conhecimento referente à dúvida informada pelo cliente
 */
function consultaDuvidaNaBaseDeConhecimento()
{
	# recuperando a dúvida do cliente
	$duvida = $_SESSION['cliente']['duvida'];

	# montando URL para a API do confluence
	$url = 'http://bc.avancoinfo.com.br/rest/searchv3/1.0/search?queryString=' . $duvida . '&where=AV&type=page';

	# utilizendo o CURL para requisitar os documentos no confluence
	$curl = curl_init();

	  curl_setopt_array($curl, array(
	      CURLOPT_RETURNTRANSFER => 1,
	      CURLOPT_URL => $url,
	      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	  ));

	  $resultado = curl_exec($curl);

  curl_close($curl);

	$documentos_confluence = array();

	# recuperando o JSON retornado pela API do confluence e transformando-o em um array
	$documentos_confluence = json_decode($resultado, true);
	$documentos_confluence = $documentos_confluence['results'];

	$documentos = array();

	# montando um array associativo com os dados retornados pela API do confluence
	foreach ($documentos_confluence as $documento) {

		# retirando posições que são diretórios e retirando caracteres especiais
		if (strpos($documento['title'], ' | ') !== false) {
				$id     = str_replace('@@@hl@@@', '', $documento['id']);
				$titulo = str_replace('@@@hl@@@', '', $documento['title']);
				$texto  = str_replace('@@@hl@@@', '', $documento['bodyTextHighlights']);

				$id     = str_replace('@@@endhl@@@', '', $id);
				$titulo = str_replace('@@@endhl@@@', '', $titulo);
				$texto  = str_replace('@@@endhl@@@', '', $texto);

				# montando um novo array associativo somente com os documentos retornados pela API do confluence
				$documentos[] = array(
						'id'     => $id,
						'titulo' => $titulo,
						'texto'  => $texto
				);

		}

	}

	# chamando função que grava os documentos em uma sessão
	criaSessaoDeDocumentos($documentos);
}

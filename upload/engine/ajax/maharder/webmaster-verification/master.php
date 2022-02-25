<?php

	//===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===
	// Mod: MetaVerification
	// File: main.php
	// Path: D:\OpenServer\domains\ingermany.local/engine/ajax/maharder/webmaster-verification/master.php
	// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  =
	// Author: Maxim Harder <dev@devcraft.club> (c) 2022
	// Website: https://devcraft.club
	// Telegram: http://t.me/MaHarder
	// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  =
	// Do not change anything!
	//===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===

	if (!defined('DATALIFEENGINE')) {
		header('HTTP/1.1 403 Forbidden');
		header('Location: ../../../../');
		exit('Hacking attempt!');
	}

	if (!$is_logged) {
		exit('error');
	}

	if ('' == $_REQUEST['user_hash'] or $_REQUEST['user_hash'] != $dle_login_hash) {
		exit('error');
	}

	$method = $_POST['method'];
	if (!$method) {
		exit();
	}
	parse_str($_POST['data'], $save_con);
	$data = [];
	$save_con = array_map(null, $save_con['service'], $save_con['content']);

	foreach ($save_con as $id => $d) {
		$name = $d[0];
		$value = $d[1];
		$value = htmlspecialchars($value);
		$data[] = ['service' => $name, 'content' => $value];
	}

	switch ($method) {
		case 'settings':
			if (!mkdir($concurrentDirectory = ENGINE_DIR . '/inc/maharder/_config', 0777, true)
				&& !is_dir(
					$concurrentDirectory
				)) {
				$mh->generate_log('webmaster-verification', 'save_setting', serialize(sprintf('Папка "%s" не была создана',
																				$concurrentDirectory)));
			}
			$file = $concurrentDirectory.'/'.$_POST['module'].'.json';


			$data = json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
			file_put_contents($file, $data);
			clear_cache();

			echo 'ok';

			break;


	}

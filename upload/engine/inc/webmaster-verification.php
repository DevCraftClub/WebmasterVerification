<?php

//===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===
// Mod: MetaVerification
// File: main.php
// Path: D:\OpenServer\domains\ingermany.local/engine/inc/webmaster-verification.php
// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  =
// Author: Maxim Harder <dev@devcraft.club> (c) 2022
// Website: https://devcraft.club
// Telegram: http://t.me/MaHarder
// ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  =
// Do not change anything!
//===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===

// заполняем важную и нужную инофрмацию о модуле

use MaHarder\classes\Admin;

$modInfo = [
	'module_name' => 'Webmaster Verification',
	'module_version' => '1.0.0',
	'module_description' => 'Создаёт мета теги в заголовке сайта для верификации разных сервисов без внедрения ',
	'module_code' => 'webmaster-verification',
	'module_icon' => 'fa-duotone fa-money-check-pen',
	'site_link' => 'https://devcraft.club',
	'docs_link' => 'https://devcraft.club/articles/webmaster-verification.15/',
	'dle_config' => $config,
	'dle_login_hash' => $dle_login_hash,
	'_get' => filter_input_array(INPUT_GET),
    '_post' => filter_input_array(INPUT_POST)
];

// Подключаем классы, функции и основные переменные
require_once DLEPlugins::Check(__DIR__.'/maharder/admin/index.php');

$mh = new Admin();
$modInfo['settings'] = $mh->getConfig($modInfo['module_code']);

// Подключаем переменные модуля и его функционал
// Используем переменную sites для навигации в модуле
switch ($_GET['sites']) {
	// Главная страница
	default:
		require_once DLEPlugins::Check(MH_ADMIN.'/modules/webmaster-verification/main.php');
		break;
	// История измениний
	case 'changelog':
		require_once DLEPlugins::Check(MH_ADMIN.'/modules/webmaster-verification/changelog.php');
		break;
}

$xtraVariable = [
	'links' => $links,
	'breadcrumbs' => $breadcrumbs,
	'settings' => $mh->getConfig($modInfo['module_code']),
];

$mh->setVars($modInfo);
$mh->setLinks($links);
$mh->setVars($xtraVariable);
$mh->setVars($modVars);

// Загружаем шаблон
$template = $mh_template->load($htmlTemplate);

// Отображаем всё на сайте
// При помощи array_merge() можно объединить любое кол-во массивов
echo $template->render($mh->getVariables());

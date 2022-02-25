<?php

$logs = [
	'1.0.0' => [
		'Основной релиз',
		'Позволяет добавить в head мета описания в виде "<meta name="YANDEX" content="123456"> не правя шаблон main.tpl',
	],
];

$modVars = [
	'title' => 'История изменений',
	'module_icon' => 'fad fa-robot',
	'logs' => $logs,
];

// Настройка хлебных крошек
// Крошки это массив с массивами, которые содержат информацию о ссылке (url) и её названии (name)
// Крошки добавляются в каждом файле модуля с исключением самого главного
$breadcrumbs[] = [
	'name' => $modVars['title'],
	'url' => $links['changelog']['href'],
];

$htmlTemplate = 'modules/admin/changelog.html';
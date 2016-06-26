<?php
/**
 * Part of the Codex Project packages.
 *
 * License and copyright information bundled with this package in the LICENSE file.
 *
 * @author    Robin Radic
 * @copyright Copyright 2016 (c) Codex Project
 * @license   http://codex-project.ninja/license The MIT License
 */

return [
    'macros' => [
        'jira:issues:list' => 'Codex\Addon\Jira\Macros\Jira@issuesList',
    ],
    'log'    => [
        'path'  => storage_path('logs/jira.log'),
        'level' => env('CODEX_JIRA_LOG_LEVEL', 'WARNING'),
    ],
];
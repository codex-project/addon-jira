<?php
/**
 * Part of the Codex Project packages.
 *
 * License and copyright information bundled with this package in the LICENSE file.
 *
 * @author Robin Radic
 * @copyright Copyright 2016 (c) Codex Project
 * @license http://codex-project.ninja/license The MIT License
 */
namespace Codex\Addon\Jira;

use JiraRestApi\Configuration\ArrayConfiguration;
use Sebwite\Support\ServiceProvider;

class JiraServiceProvider extends ServiceProvider
{


    public function register()
    {
        $app = parent::register();
        config([
            'codex.processors.macros.jira:issues:list' => 'App\Codex\Macros\Jira@issuesList',
            'codex.processors.macros.jira:issues:count' => 'App\Codex\Macros\Jira@issuesCount',
        ]);
        $app->singleton('codex.jira', function($app){
            return new JiraFactory($app['codex.jira.credentials']);
        });

        $app->bind('codex.jira.credentials', function ($app)
        {
            return new ArrayConfiguration([
                'jiraHost'     => config('services.jira.host'),
                'jiraUser'     => config('services.jira.username'),
                'jiraPassword' => config('services.jira.password'),
                'jiraLogFile'  => storage_path('logs/jira.log'),
            ]);
        });
        return $app;
    }
}
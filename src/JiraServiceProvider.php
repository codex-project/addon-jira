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
namespace Codex\Addon\Jira;

use Codex\Traits\CodexProviderTrait;
use JiraRestApi\Configuration\ArrayConfiguration;
use Laradic\ServiceProvider\ServiceProvider;

class JiraServiceProvider extends ServiceProvider
{
    use CodexProviderTrait;

    protected $dir = __DIR__;

    protected $configFiles = [ 'codex-jira' ];

    protected $viewDirs = [ 'views' => 'codex-jira' ];

    public function register()
    {
        $app = parent::register();
        $this->registerJiraMacros();
        $this->registerJira();
        $this->registerJiraCredentials();
        $this->codexView('macros.jira.list-issues', 'codex-jira::list-issues');
        return $app;
    }

    protected function registerJiraCredentials()
    {
        $this->app->bind('codex.jira.credentials', function ($app)
        {
            return new ArrayConfiguration([
                'jiraHost'     => config('services.jira.host'),
                'jiraUser'     => config('services.jira.username'),
                'jiraPassword' => config('services.jira.password'),
                'jiraLogLevel' => config('codex-jira.log.level', 'WARNING'),
                'jiraLogFile'  => config('codex-jira.log.path', storage_path('logs/jira.log')),
            ]);
        });
    }

    protected function registerJira()
    {
        $this->app->singleton('codex.jira', function ($app)
        {
            return new JiraFactory($app[ 'codex.jira.credentials' ]);
        });
    }

    protected function registerJiraMacros()
    {
        foreach ( config('codex-jira.macros', [ ]) as $macro => $handler )
        {
            config([ 'codex.processors.macros.' . $macro => $handler ]);
        }
    }

}

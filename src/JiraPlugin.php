<?php
/**
 * Part of the Codex Project packages.
 *
 * License and copyright information bundled with this package in the LICENSE file.
 *
 * @author Robin Radic
 * @copyright Copyright 2017 (c) Codex Project
 * @license http://codex-project.ninja/license The MIT License
 */
namespace Codex\Addon\Jira;


use Codex\Addons\Annotations as CA;
use Codex\Addons\BasePlugin;
use JiraRestApi\Configuration\ArrayConfiguration;

/**
 * This is the class JiraPlugin.
 *
 * @package        Codex\Addon
 * @author         Radic
 * @copyright      Copyright (c) 2015, Radic. All rights reserved
 * @CA\Plugin("jira")
 */
class JiraPlugin extends BasePlugin
{
    /**
     * Register codex views
     *
     * @var array
     */
    protected $views = [ 'macros.jira.list-issues' => 'codex-jira::list-issues' ];


    protected $configFiles = [ 'codex-jira' ];

    protected $viewDirs = [ 'views' => 'codex-jira' ];

    public function register()
    {
        $app = parent::register();

        // register macros in codex
        foreach ( config('codex-jira.macros', []) as $macro => $handler ) {
            config([ 'codex.processors.macros.' . $macro => $handler ]);
        }

        // Register the JiraFactory
        $this->app->singleton('codex.jira', function ($app) {
            $credentials = new ArrayConfiguration([
                'jiraHost'     => config('services.jira.host'),
                'jiraUser'     => config('services.jira.username'),
                'jiraPassword' => config('services.jira.password'),
                'jiraLogLevel' => config('codex-jira.log.level', 'WARNING'),
                'jiraLogFile'  => config('codex-jira.log.path', storage_path('logs/jira.log')),
            ]);
            return new JiraFactory($credentials);
        });


        return $app;
    }
}

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

/**
 * This is the class JiraAddon.
 *
 * @package        App\Codex
 * @author         Robin Radic
 * @ Addon("jira")
 *
 *
 */
class JiraAddon
{


    /** @var \Codex\Codex */
    public $codex;

    /** @var \Codex\Support\Collection|array */
    public $config = [ ];

    public $filters = [ ];

    public $views = [ ];

    /** @var \Illuminate\Support\ServiceProvider[]|array */
    public $providers = [ ];


}
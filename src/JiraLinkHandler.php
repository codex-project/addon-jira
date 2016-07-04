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

/**
 * Created by IntelliJ IDEA.
 * User: radic
 * Date: 7/4/16
 * Time: 8:21 AM
 */

namespace Codex\Addon\Jira;


class JiraLinkHandler
{
    protected $jira;

    /**
     * JiraLinkHandler constructor.
     *
     * @param $jira
     */
    public function __construct(JiraFactory $jira) { $this->jira = $jira; }

    public function getJira()
    {
        return $this->jira;
    }


}

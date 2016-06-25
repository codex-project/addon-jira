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

use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Project\Project;
use JiraRestApi\Project\ProjectService;

class JiraFactory
{
    protected $credentials;

    protected $service = [ ];

    /**
     * JiraFactory constructor.
     *
     * @param $credentials
     */
    public function __construct(ConfigurationInterface $credentials)
    {
        $this->credentials = $credentials;
    }


    /**
     * projects method
     * @return \JiraRestApi\Project\ProjectService
     */
    public function projects()
    {
        return new ProjectService($this->credentials);
    }

    /**
     * issues method
     * @return \JiraRestApi\Issue\IssueService
     */
    public function issues()
    {
        return new IssueService($this->credentials);
    }

    /**
     * getProjects method
     * @return Project[]
     */
    public function getProjects()
    {
        return $this->projects()->getAllProjects();
    }

    /**
     * getProject method
     *
     * @param string $key
     *
     * @return Project
     */
    public function getProject($key)
    {
        return $this->projects()->get($key);
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set the credentials value
     *
     * @param mixed $credentials
     *
     * @return JiraFactory
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }


}
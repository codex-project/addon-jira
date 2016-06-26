<?php
// just here for code-completion and shows what can be done
$testFunc = function (\JiraRestApi\Issue\IssueSearchResult $result)
{
    $result->getTotal();
    foreach ( $result->getIssues() as $_issue )
    {
        $issue = $_issue->fields;

        $type    = $issue->getIssueType();
        $status  = $issue->status;
        $creator = $issue->creator;
        $type->iconUrl;
        $type->name;

        // type icon + name
        $issue->getIssueType()->iconUrl;
        $issue->getIssueType()->name;

        // key with link (CODEX-23)
        url()->to(config('services.jira.host') . '/browse/' . $_issue->key);
        $_issue->key;

        // status
        $issue->status->iconUrl;
        $issue->status->name;

        // components
        $issue->components[ 0 ]->name;
        $issue->components[ 0 ]->description;

        // fix versions
        $issue->fixVersions[ 0 ]->name;
        $issue->fixVersions[ 0 ]->description;
        $issue->fixVersions[ 0 ]->released;

        // priority
        $issue->priority->iconUrl;
        $issue->priority->name;

        // reporter oir creator
        $issue->creator->displayName;
        $issue->reporter->displayName;
        $issue->reporter->name; // login
        $issue->reporter->emailAddress;
        $issue->reporter->avatarUrls;

        // DateTime
        $issue->created->format('');

        // desc
        $issue->description;
    }
}
?>
{{--{!! ddd($issues) !!}--}}
<style type="text/css">
    .aui-lozenge {
        background: #ccc;
        border: 1px solid #ccc;
        border-radius: 3px;
        color: #333;
        display: inline-block;
        font-size: 11px;
        font-weight: bold;
        line-height: 99%;
        margin: 0;
        padding: 2px 5px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;

        font-family: Arial,sans-serif;
    }
    .jira-issue-status-lozenge {
        vertical-align: text-bottom;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 12em;

        /* this is here for IE */
        word-wrap: normal;
        word-break: normal;
    }

    .jira-issue-status-render-error {
        color: #d04437;
    }

    /* Colors */

    .aui-lozenge.jira-issue-status-lozenge-green {
        background-color: #14892c;
        border-color: #14892c;
        color: #fff;
    }

    .aui-lozenge.aui-lozenge-subtle.jira-issue-status-lozenge-green {
        background-color: #fff;
        border-color: #b2d8b9;
        color: #14892c;
    }

    .aui-lozenge.jira-issue-status-lozenge-yellow {
        background-color: #ffd351;
        border-color: #ffd351;
        color: #594300;
    }

    .aui-lozenge.aui-lozenge-subtle.jira-issue-status-lozenge-yellow {
        background-color: #fff;
        border-color: #ffe28c;
        color: #594300;
    }

    .aui-lozenge.jira-issue-status-lozenge-brown {
        background-color: #815b3a;
        border-color: #815b3a;
        color: #fff;
    }

    .aui-lozenge.aui-lozenge-subtle.jira-issue-status-lozenge-brown {
        background-color: #fff;
        border-color: #ece7e2;
        color: #815b3a;
    }

    .aui-lozenge.jira-issue-status-lozenge-warm-red {
        background-color: #d04437;
        border-color: #d04437;
        color: #fff;
    }

    .aui-lozenge.aui-lozenge-subtle.jira-issue-status-lozenge-warm-red {
        background-color: #fff;
        border-color: #f8d3d1;
        color: #d04437;
    }

    .aui-lozenge.jira-issue-status-lozenge-blue-gray {
        background-color: #4a6785;
        border-color: #4a6785;
        color: #fff;
    }

    .aui-lozenge.aui-lozenge-subtle.jira-issue-status-lozenge-blue-gray {
        background-color: #fff;
        border-color: #e4e8ed;
        color: #4a6785;
    }

    .aui-lozenge.jira-issue-status-lozenge-medium-gray {
        background-color: #ccc;
        border-color: #ccc;
        color: #333;
    }

    .aui-lozenge.aui-lozenge-subtle.jira-issue-status-lozenge-medium-gray {
        background-color: #fff;
        border-color: #ccc;
        color: #333;
    }

    /* Compact lozenge */

    .aui-lozenge.jira-issue-status-lozenge-compact {
        width: 4px;
        text-align: left;
        text-indent: -9999px;
    }

    /* Tooltips */

    .jira-issue-status-tooltip .tipsy-inner {
        text-align: left;
    }

    .jira-issue-status-tooltip .jira-issue-status-tooltip-title {
        text-transform: uppercase;
    }

    .jira-issue-status-tooltip .jira-issue-status-tooltip-desc {
        color: #ccc;
    }

    /* For lozenge truncating */

    .jira-issue-status-lozenge-max-width-short {
        max-width: 8em;
    }

    .jira-issue-status-lozenge-max-width-medium {
        max-width: 12em;
    }

    .jira-issue-status-lozenge-max-width-long {
        max-width: 20em;
    }

    .codex-jira-macro-issues {

    }
    .codex-jira-macro-issues tbody td img.icon {
        height: 16px;
        width: 16px;
    }
    .codex-jira-macro-issues tbody td.status {
        text-align: center;
        padding: 6px;
    }
</style>
<div class="codex-jira-macro-issues">
    <table class="table table-bordered table-condensed">
        <thead>
        <tr>
            @if(in_array('type', $show))
                <th class="text-center" width="20">TP</th>
            @endif
            @if(in_array('id', $show))
                <th class="text-center" width="100">ID</th>
            @endif
            @if(in_array('summary', $show))
                <th>Summary</th>
            @endif
            @if(in_array('status', $show))
                <th class="text-center" width="150">Status</th>
            @endif
            @if(in_array('components', $show))
                <th>Components</th>
            @endif
            @if(in_array('fix-versions', $show))
                <th>Version</th>
            @endif
            @if(in_array('priority', $show))
                <th class="text-center" width="20">PR</th>
            @endif
            @if(in_array('reporter', $show))
                <th class="text-center" width="20">By</th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($issues->getIssues() as $_issue)
            @set($issue, $_issue->fields)
            <tr>
                @if(in_array('type', $show))
                    <td class="text-center"><img class="icon" rel="tooltip" src="{{ $issue->getIssueType()->iconUrl }}" title="{{ $issue->getIssueType()->name }}"/></td>
                @endif
                @if(in_array('id', $show))
                    <td class="text-right"><a href="{{ url()->to(config('services.jira.host') . '/browse/' . $_issue->key) }}" target="_blank">{{ $_issue->key }}</a></td>
                @endif
                @if(in_array('summary', $show))
                    <td>{{ $issue->summary }}</td>
                @endif
                @if(in_array('status', $show))
                    <td class="status" >
                        <span class=" jira-issue-status-lozenge aui-lozenge jira-issue-status-lozenge-blue-gray jira-issue-status-lozenge-new jira-issue-status-lozenge-max-width-medium"
                              rel="tooltip" title="{{ $issue->status->description }}">
                            {{ $issue->status->name }}
                        </span>
                    </td>
                @endif
                @if(in_array('components', $show))
                    <td>{{ empty($issue->components) ? '' : $issue->components[0]->name }}</td>
                @endif
                @if(in_array('fix-versions', $show))
                    <td>{{ !empty($issue->fixVersions) ? $issue->fixVersions[0]->name : '' }}</td>
                @endif
                @if(in_array('priority', $show))
                    <td class="text-center" ><img class="icon" rel="tooltip" src="{{ $issue->priority->iconUrl }}" alt="{{ $issue->priority->name }}" title="{{ $issue->priority->name }}" data-toggle="tooltip"/></td>
                @endif
                @if(in_array('reporter', $show))
                    <td class="text-center" ><img class="icon" rel="tooltip" src="{{ array_get((array) $issue->reporter->avatarUrls, '48x48') }}" alt="{{ $issue->reporter->displayName }}" title="{{ $issue->reporter->displayName }}"/></td>
                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
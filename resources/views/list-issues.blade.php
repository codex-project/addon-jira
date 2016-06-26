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
{!! ddd($issues) !!}
<style type="text/css">
    .codex-jira-macro-issues {

    }
    .codex-jira-macro-issues tbody td img.icon {
        height: 16px;
        width: 16px;
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
                <th>Status</th>
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
                    <td class="text-center"><img class="icon" src="{{ $issue->getIssueType()->iconUrl }}" title="{{ $issue->getIssueType()->name }}"/></td>
                @endif
                @if(in_array('id', $show))
                    <td class="text-right"><a href="{{ url()->to(config('services.jira.host') . '/browse/' . $_issue->key) }}" target="_blank">{{ $_issue->key }}</a></td>
                @endif
                @if(in_array('summary', $show))
                    <td>{{ $issue->summary }}</td>
                @endif
                @if(in_array('status', $show))
                    <td><img src="{{ $issue->status->iconUrl }}" alt="{{ $issue->status->name }}" title="{{ $issue->status->name }}"/></td>
                @endif
                @if(in_array('components', $show))
                    <td>{{ empty($issue->components) ? '' : $issue->components[0]->name }}</td>
                @endif
                @if(in_array('fix-versions', $show))
                    <td>{{ !empty($issue->fixVersions) ? $issue->fixVersions[0]->name : '' }}</td>
                @endif
                @if(in_array('priority', $show))
                    <td class="text-center" ><img class="icon" src="{{ $issue->priority->iconUrl }}" alt="{{ $issue->priority->name }}" title="{{ $issue->priority->name }}" data-toggle="tooltip"/></td>
                @endif
                @if(in_array('reporter', $show))
                    <td class="text-center" ><img class="icon" src="{{ array_get((array) $issue->reporter->avatarUrls, '48x48') }}" alt="{{ $issue->reporter->displayName }}" title="{{ $issue->reporter->displayName }}"/></td>
                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
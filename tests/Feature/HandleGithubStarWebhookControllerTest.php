<?php

namespace Tests\Feature;

use App\Models\Repository;
use Illuminate\Support\Str;
use Tests\TestCase;

class HandleGithubStarWebhookControllerTest extends TestCase
{
    public function test_it_update_repository_stars_when_webhook_is_received()
    {
        $payload = <<<JSON
{
  "zen": "Half measures are as bad as nothing at all.",
  "hook_id": 361612418,
  "hook": {
    "type": "Repository",
    "id": 361612418,
    "name": "web",
    "active": true,
    "events": [
      "star",
      "watch"
    ],
    "config": {
      "content_type": "form",
      "insecure_ssl": "0",
      "secret": "********",
      "url": "https://junges.dev/api/webhooks/github/star"
    },
    "updated_at": "2022-06-04T01:13:03Z",
    "created_at": "2022-06-04T01:13:03Z",
    "url": "https://api.github.com/repos/mateusjunges/test-repository/hooks/361612418",
    "test_url": "https://api.github.com/repos/mateusjunges/test-repository/hooks/361612418/test",
    "ping_url": "https://api.github.com/repos/mateusjunges/test-repository/hooks/361612418/pings",
    "deliveries_url": "https://api.github.com/repos/mateusjunges/test-repository/hooks/361612418/deliveries",
    "last_response": {
      "code": null,
      "status": "unused",
      "message": null
    }
  },
  "repository": {
    "id": 396570683,
    "node_id": "MDEwOlJlcG9zaXRvcnkzOTY1NzA2ODM=",
    "name": "test-repository",
    "full_name": "mateusjunges/test-repository",
    "private": false,
    "owner": {
      "login": "mateusjunges",
      "id": 19756164,
      "node_id": "MDQ6VXNlcjE5NzU2MTY0",
      "avatar_url": "https://avatars.githubusercontent.com/u/19756164?v=4",
      "gravatar_id": "",
      "url": "https://api.github.com/users/mateusjunges",
      "html_url": "https://github.com/mateusjunges",
      "followers_url": "https://api.github.com/users/mateusjunges/followers",
      "following_url": "https://api.github.com/users/mateusjunges/following{/other_user}",
      "gists_url": "https://api.github.com/users/mateusjunges/gists{/gist_id}",
      "starred_url": "https://api.github.com/users/mateusjunges/starred{/owner}{/repo}",
      "subscriptions_url": "https://api.github.com/users/mateusjunges/subscriptions",
      "organizations_url": "https://api.github.com/users/mateusjunges/orgs",
      "repos_url": "https://api.github.com/users/mateusjunges/repos",
      "events_url": "https://api.github.com/users/mateusjunges/events{/privacy}",
      "received_events_url": "https://api.github.com/users/mateusjunges/received_events",
      "type": "User",
      "site_admin": false
    },
    "html_url": "https://github.com/mateusjunges/test-repository",
    "description": "Use Kafka Producers and Consumers in your laravel app with ease!",
    "fork": false,
    "url": "https://api.github.com/repos/mateusjunges/test-repository",
    "forks_url": "https://api.github.com/repos/mateusjunges/test-repository/forks",
    "keys_url": "https://api.github.com/repos/mateusjunges/test-repository/keys{/key_id}",
    "collaborators_url": "https://api.github.com/repos/mateusjunges/test-repository/collaborators{/collaborator}",
    "teams_url": "https://api.github.com/repos/mateusjunges/test-repository/teams",
    "hooks_url": "https://api.github.com/repos/mateusjunges/test-repository/hooks",
    "issue_events_url": "https://api.github.com/repos/mateusjunges/test-repository/issues/events{/number}",
    "events_url": "https://api.github.com/repos/mateusjunges/test-repository/events",
    "assignees_url": "https://api.github.com/repos/mateusjunges/test-repository/assignees{/user}",
    "branches_url": "https://api.github.com/repos/mateusjunges/test-repository/branches{/branch}",
    "tags_url": "https://api.github.com/repos/mateusjunges/test-repository/tags",
    "blobs_url": "https://api.github.com/repos/mateusjunges/test-repository/git/blobs{/sha}",
    "git_tags_url": "https://api.github.com/repos/mateusjunges/test-repository/git/tags{/sha}",
    "git_refs_url": "https://api.github.com/repos/mateusjunges/test-repository/git/refs{/sha}",
    "trees_url": "https://api.github.com/repos/mateusjunges/test-repository/git/trees{/sha}",
    "statuses_url": "https://api.github.com/repos/mateusjunges/test-repository/statuses/{sha}",
    "languages_url": "https://api.github.com/repos/mateusjunges/test-repository/languages",
    "stargazers_url": "https://api.github.com/repos/mateusjunges/test-repository/stargazers",
    "contributors_url": "https://api.github.com/repos/mateusjunges/test-repository/contributors",
    "subscribers_url": "https://api.github.com/repos/mateusjunges/test-repository/subscribers",
    "subscription_url": "https://api.github.com/repos/mateusjunges/test-repository/subscription",
    "commits_url": "https://api.github.com/repos/mateusjunges/test-repository/commits{/sha}",
    "git_commits_url": "https://api.github.com/repos/mateusjunges/test-repository/git/commits{/sha}",
    "comments_url": "https://api.github.com/repos/mateusjunges/test-repository/comments{/number}",
    "issue_comment_url": "https://api.github.com/repos/mateusjunges/test-repository/issues/comments{/number}",
    "contents_url": "https://api.github.com/repos/mateusjunges/test-repository/contents/{+path}",
    "compare_url": "https://api.github.com/repos/mateusjunges/test-repository/compare/{base}...{head}",
    "merges_url": "https://api.github.com/repos/mateusjunges/test-repository/merges",
    "archive_url": "https://api.github.com/repos/mateusjunges/test-repository/{archive_format}{/ref}",
    "downloads_url": "https://api.github.com/repos/mateusjunges/test-repository/downloads",
    "issues_url": "https://api.github.com/repos/mateusjunges/test-repository/issues{/number}",
    "pulls_url": "https://api.github.com/repos/mateusjunges/test-repository/pulls{/number}",
    "milestones_url": "https://api.github.com/repos/mateusjunges/test-repository/milestones{/number}",
    "notifications_url": "https://api.github.com/repos/mateusjunges/test-repository/notifications{?since,all,participating}",
    "labels_url": "https://api.github.com/repos/mateusjunges/test-repository/labels{/name}",
    "releases_url": "https://api.github.com/repos/mateusjunges/test-repository/releases{/id}",
    "deployments_url": "https://api.github.com/repos/mateusjunges/test-repository/deployments",
    "created_at": "2021-08-16T01:52:48Z",
    "updated_at": "2022-06-03T15:09:56Z",
    "pushed_at": "2022-06-03T23:42:53Z",
    "git_url": "git://github.com/mateusjunges/test-repository.git",
    "ssh_url": "git@github.com:mateusjunges/test-repository.git",
    "clone_url": "https://github.com/mateusjunges/test-repository.git",
    "svn_url": "https://github.com/mateusjunges/test-repository",
    "homepage": "https://junges.dev/documentation/test-repository/v1.7/1-introduction",
    "size": 734,
    "stargazers_count": 242,
    "watchers_count": 242,
    "language": "PHP",
    "has_issues": true,
    "has_projects": true,
    "has_downloads": true,
    "has_wiki": true,
    "has_pages": false,
    "forks_count": 27,
    "mirror_url": null,
    "archived": false,
    "disabled": false,
    "open_issues_count": 3,
    "license": {
      "key": "mit",
      "name": "MIT License",
      "spdx_id": "MIT",
      "url": "https://api.github.com/licenses/mit",
      "node_id": "MDc6TGljZW5zZTEz"
    },
    "allow_forking": true,
    "is_template": false,
    "topics": [
      "hacktoberfest",
      "kafka",
      "message",
      "php"
    ],
    "visibility": "public",
    "forks": 27,
    "open_issues": 3,
    "watchers": 242,
    "default_branch": "v1.7.x"
  },
  "sender": {
    "login": "mateusjunges",
    "id": 19756164,
    "node_id": "MDQ6VXNlcjE5NzU2MTY0",
    "avatar_url": "https://avatars.githubusercontent.com/u/19756164?v=4",
    "gravatar_id": "",
    "url": "https://api.github.com/users/mateusjunges",
    "html_url": "https://github.com/mateusjunges",
    "followers_url": "https://api.github.com/users/mateusjunges/followers",
    "following_url": "https://api.github.com/users/mateusjunges/following{/other_user}",
    "gists_url": "https://api.github.com/users/mateusjunges/gists{/gist_id}",
    "starred_url": "https://api.github.com/users/mateusjunges/starred{/owner}{/repo}",
    "subscriptions_url": "https://api.github.com/users/mateusjunges/subscriptions",
    "organizations_url": "https://api.github.com/users/mateusjunges/orgs",
    "repos_url": "https://api.github.com/users/mateusjunges/repos",
    "events_url": "https://api.github.com/users/mateusjunges/events{/privacy}",
    "received_events_url": "https://api.github.com/users/mateusjunges/received_events",
    "type": "User",
    "site_admin": false
  }
}
JSON;

        /** @var \App\Models\Repository $repository */
        $repository = Repository::factory()->create([
            'name' => 'test-repository'
        ]);

        config()->set('services.github.should_verify_webhook_signature', false);

        $this->post('/api/webhooks/github/repo-starred', $payloadArray = json_decode($payload, true), [
            'X-Hub-Signature' => "sha1=".hash_hmac('sha1', $payload, Str::repeat('a', 32))
        ]);

        $expectedStars = $payloadArray['repository']['stargazers_count'];

        $this->assertEquals($expectedStars, $repository->refresh()->stars);
    }
}

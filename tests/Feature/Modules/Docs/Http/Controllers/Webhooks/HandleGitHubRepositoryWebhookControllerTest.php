<?php declare(strict_types=1);

namespace Tests\Feature\Modules\Docs\Http\Controllers\Webhooks;

use App\Modules\Docs\Contracts\ValueStoreDriver;
use App\Modules\Docs\ValueStores\Drivers\ArrayValueStoreDriver;
use App\Modules\Docs\ValueStores\UpdatedRepositoriesValueStore;
use Illuminate\Support\Str;
use Tests\Factories\RepositoryFactory;
use Tests\TestCase;

final class HandleGitHubRepositoryWebhookControllerTest extends TestCase
{
    /** @test */
    public function it_should_add_the_repository_to_updated_repositories_value_store(): void
    {
        (new RepositoryFactory())->createOne([
            'name' => 'mateusjunges/laravel-kafka'
        ]);
        config()->set('services.github.should_verify_webhook_signature', false);

        $this->app->bind(ValueStoreDriver::class, function () {
            return new ArrayValueStoreDriver();
        });

        $this->assertNotContains('mateusjunges/laravel-kafka', UpdatedRepositoriesValueStore::make()->getNames());

        $payload = $this->getPayload();
        $this->post('/api/webhooks/github/', json_decode($payload, true, 512, JSON_THROW_ON_ERROR), [
            'X-Hub-Signature' => "sha1=".hash_hmac('sha1', $payload, Str::repeat('a', 32))
        ]);

        $this->assertContains('mateusjunges/laravel-kafka', UpdatedRepositoriesValueStore::make()->getNames());
    }

    private function getPayload(): string
    {
        return <<<JSON
{
  "ref": "refs/heads/v2.x",
  "before": "0000000000000000000000000000000000000000",
  "after": "e39aec449fb0b6bc22fe9cb97458d2f220c12bba",
  "repository": {
    "id": 396570683,
    "node_id": "MDEwOlJlcG9zaXRvcnkzOTY1NzA2ODM=",
    "name": "laravel-kafka",
    "full_name": "mateusjunges/laravel-kafka",
    "private": false,
    "owner": {
      "name": "mateusjunges",
      "email": "mateus@junges.dev",
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
    "html_url": "https://github.com/mateusjunges/laravel-kafka",
    "description": "Use Kafka Producers and Consumers in your laravel app with ease!",
    "fork": false,
    "url": "https://github.com/mateusjunges/laravel-kafka",
    "forks_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/forks",
    "keys_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/keys{/key_id}",
    "collaborators_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/collaborators{/collaborator}",
    "teams_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/teams",
    "hooks_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/hooks",
    "issue_events_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/issues/events{/number}",
    "events_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/events",
    "assignees_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/assignees{/user}",
    "branches_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/branches{/branch}",
    "tags_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/tags",
    "blobs_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/git/blobs{/sha}",
    "git_tags_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/git/tags{/sha}",
    "git_refs_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/git/refs{/sha}",
    "trees_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/git/trees{/sha}",
    "statuses_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/statuses/{sha}",
    "languages_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/languages",
    "stargazers_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/stargazers",
    "contributors_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/contributors",
    "subscribers_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/subscribers",
    "subscription_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/subscription",
    "commits_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/commits{/sha}",
    "git_commits_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/git/commits{/sha}",
    "comments_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/comments{/number}",
    "issue_comment_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/issues/comments{/number}",
    "contents_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/contents/{+path}",
    "compare_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/compare/{base}...{head}",
    "merges_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/merges",
    "archive_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/{archive_format}{/ref}",
    "downloads_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/downloads",
    "issues_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/issues{/number}",
    "pulls_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/pulls{/number}",
    "milestones_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/milestones{/number}",
    "notifications_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/notifications{?since,all,participating}",
    "labels_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/labels{/name}",
    "releases_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/releases{/id}",
    "deployments_url": "https://api.github.com/repos/mateusjunges/laravel-kafka/deployments",
    "created_at": 1629078768,
    "updated_at": "2022-12-13T17:38:57Z",
    "pushed_at": 1671331486,
    "git_url": "git://github.com/mateusjunges/laravel-kafka.git",
    "ssh_url": "git@github.com:mateusjunges/laravel-kafka.git",
    "clone_url": "https://github.com/mateusjunges/laravel-kafka.git",
    "svn_url": "https://github.com/mateusjunges/laravel-kafka",
    "homepage": "https://junges.dev/documentation/laravel-kafka",
    "size": 867,
    "stargazers_count": 320,
    "watchers_count": 320,
    "language": "PHP",
    "has_issues": true,
    "has_projects": true,
    "has_downloads": true,
    "has_wiki": true,
    "has_pages": false,
    "has_discussions": false,
    "forks_count": 40,
    "mirror_url": null,
    "archived": false,
    "disabled": false,
    "open_issues_count": 4,
    "license": {
      "key": "mit",
      "name": "MIT License",
      "spdx_id": "MIT",
      "url": "https://api.github.com/licenses/mit",
      "node_id": "MDc6TGljZW5zZTEz"
    },
    "allow_forking": true,
    "is_template": false,
    "web_commit_signoff_required": false,
    "topics": [
      "hacktoberfest",
      "kafka",
      "laravel",
      "message",
      "php"
    ],
    "visibility": "public",
    "forks": 40,
    "open_issues": 4,
    "watchers": 320,
    "default_branch": "v1.10.x",
    "stargazers": 320,
    "master_branch": "v1.10.x"
  },
  "pusher": {
    "name": "mateusjunges",
    "email": "mateus@junges.dev"
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
  },
  "created": true,
  "deleted": false,
  "forced": false,
  "base_ref": "refs/heads/v1.10.x",
  "compare": "https://github.com/mateusjunges/laravel-kafka/compare/v2.x",
  "commits": [

  ],
  "head_commit": {
    "id": "e39aec449fb0b6bc22fe9cb97458d2f220c12bba",
    "tree_id": "0db33f218b5cfaddafad3b53955826e2b5a0ec7d",
    "distinct": true,
    "message": "changelog",
    "timestamp": "2022-12-17T23:42:16-03:00",
    "url": "https://github.com/mateusjunges/laravel-kafka/commit/e39aec449fb0b6bc22fe9cb97458d2f220c12bba",
    "author": {
      "name": "Mateus Junges",
      "email": "mateus@junges.dev",
      "username": "mateusjunges"
    },
    "committer": {
      "name": "Mateus Junges",
      "email": "mateus@junges.dev",
      "username": "mateusjunges"
    },
    "added": [

    ],
    "removed": [

    ],
    "modified": [
      "CHANGELOG.md"
    ]
  }
}
JSON;
    }
}

rm -rf storage/framework/cache/docs/
rm -rf public/docs
rm -rf storage/docs

touch storage/app/updatesRepositories.json

echo '{"updatedRepositoryNames":["mateusjunges\/laravel-kafka", "mateusjunges\/laravel-acl", "mateusjunges\/trackable-jobs-for-laravel"]}' >> storage/app/updatesRepositories.json
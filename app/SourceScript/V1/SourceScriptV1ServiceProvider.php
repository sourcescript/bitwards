<?php  namespace SourceScript\V1;

use Illuminate\Support\ServiceProvider;

class SourceScriptV1ServiceProvider extends ServiceProvider {
    protected $defer = false;

    public function boot()
    {
        // bind repositories to it's interfaces
        $this->bindRepositories();
    }

    public function bindRepositories()
    {
        // Sample Binding of Model Repository
        $this->app->bind('SourceScript\V1\Model\ModelRepositoryInterface', function() {
            return new Model\EloquentModelRepository(new Model\ModelEloquentModel);
        });

        $this->app->bind('SourceScript\V1\User\UserRepositoryInterface', function() {
            return new User\EloquentUserRepository(new User\UserEloquentModel);
        });

        $this->app->bind('SourceScript\V1\Challenges\ChallengesRepositoryInterface', function() {
            return new Challenges\EloquentChallengesRepository(new Challenges\ChallengesEloquentModel);
        });
    }

    public function register() {}

    public function provides()
    {
        return [];
    }

}

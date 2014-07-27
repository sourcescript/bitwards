<?php  namespace SourceScript\V1\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use SourceScript\V1\API\ApiController;
use SourceScript\V1\User\Validators\UserCreateValidator;
use SourceScript\V1\User\Validators\UserUpdateValidator;
use ResourceServer;
use Input;

class UserController extends ApiController {

    protected $UserRepository;
    protected $UserTransformer;
    private $UserCreateValidator;
    private $UserUpdateValidator;

    public function __construct(
        EloquentUserRepository $UserRepository,
        UserTransformer $UserTransformer,
        UserCreateValidator $UserCreateValidator,
        UserUpdateValidator $UserUpdateValidator
    )
    {
        $this->UserRepository = $UserRepository;
        $this->UserTransformer = $UserTransformer;
        $this->UserCreateValidator = $UserCreateValidator;
        $this->UserUpdateValidator = $UserUpdateValidator;
    }

    public function userProfile()
    {
        $userId = ResourceServer::getOwnerId();

        return $this->show($userId);
    }

    public function acceptChallenge($id)
    {
        $userId = ResourceServer::getOwnerId();

        $this->UserRepository->addChallenge($userId, $id);

        return $this->respond(['status' => 'success']);
    }

    public function finishChallenge($id)
    {
        $userId = ResourceServer::getOwnerId();

        if(! $this->UserRepository->finishChallenge($userId, $id)) {
            return $this->respond(['status' => 'error']);
        }

        $User = $this->UserRepository->findOrFail($userId);

        $transformedData = $this->UserTransformer->transform($User);

        $response = $this->respondItem($transformedData);

        return $response;
    }

    public function claimReward($id)
    {
        $userId = ResourceServer::getOwnerId();

        if(! ($reward = $this->UserRepository->claimReward($userId, $id))) {
            return $this->respond(['status' => 'error']);
        }

        return $this->respond([
            'status' => 'success',
            'reward' => $reward
        ]);
    }

    public function index()
    {
        $limit = Input::get('limit') ?: 10;
        $limit = ($limit <= 50) ? $limit : 50;

        $Users = $this->UserRepository->paginate($limit);

        $transformedData = $this->UserTransformer->transformCollection($Users);

        return $this->respondCollection($Users, $transformedData);
    }

    public function store()
    {
        $input = Input::only([]);

        if($User = $this->UserRepository->create($input, $this->UserCreateValidator)) {
            $transformedData = $this->UserTransformer->transform($User);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->UserCreateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function show($id)
    {
        try {
            $User = $this->UserRepository->findOrFail($id);

            $transformedData = $this->UserTransformer->transform($User);

            $response = $this->respondItem($transformedData);

        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('User not found.', 1404);

        }

        return $response;
    }

    public function update($id)
    {
        $input = Input::only([]);

        if($User = $this->UserRepository->update($input, $id, $this->UserUpdateValidator->setId($id))) {
            $transformedData = $this->UserTransformer->transform($User);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->UserUpdateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function destroy($id)
    {
        try {
            $this->UserRepository->delete($id);

            $response = $this->respondDeleted('User successfully deleted.');
        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('User to be deleted not found.', 1404);

        }

        return $response;
    }

} 

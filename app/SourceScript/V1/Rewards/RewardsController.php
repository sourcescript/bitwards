<?php  namespace SourceScript\V1\Rewards;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use SourceScript\V1\API\ApiController;
use SourceScript\V1\Rewards\Validators\RewardsCreateValidator;
use SourceScript\V1\Rewards\Validators\RewardsUpdateValidator;
use Input;

class RewardsController extends ApiController {

    protected $RewardsRepository;
    protected $RewardsTransformer;
    private $RewardsCreateValidator;
    private $RewardsUpdateValidator;

    public function __construct(
        EloquentRewardsRepository $RewardsRepository,
        RewardsTransformer $RewardsTransformer,
        RewardsCreateValidator $RewardsCreateValidator,
        RewardsUpdateValidator $RewardsUpdateValidator
    )
    {
        $this->RewardsRepository = $RewardsRepository;
        $this->RewardsTransformer = $RewardsTransformer;
        $this->RewardsCreateValidator = $RewardsCreateValidator;
        $this->RewardsUpdateValidator = $RewardsUpdateValidator;
    }

    public function index()
    {
        $limit = Input::get('limit') ?: 10;
        $limit = ($limit <= 50) ? $limit : 50;

        $Rewardss = $this->RewardsRepository->paginate($limit);

        $transformedData = $this->RewardsTransformer->transformCollection($Rewardss);

        return $this->respondCollection($Rewardss, $transformedData);
    }

    public function store()
    {
        $input = Input::only([]);

        if($Rewards = $this->RewardsRepository->create($input, $this->RewardsCreateValidator)) {
            $transformedData = $this->RewardsTransformer->transform($Rewards);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->RewardsCreateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function show($id)
    {
        try {
            $Rewards = $this->RewardsRepository->findOrFail($id);
            $transformedData = $this->RewardsTransformer->transform($Rewards);

            $response = $this->respondItem($transformedData);

        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Rewards not found.', 1404);

        }

        return $response;
    }

    public function update($id)
    {
        $input = Input::only([]);

        if($Rewards = $this->RewardsRepository->update($input, $id, $this->RewardsUpdateValidator->setId($id))) {
            $transformedData = $this->RewardsTransformer->transform($Rewards);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->RewardsUpdateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function destroy($id)
    {
        try {
            $this->RewardsRepository->delete($id);

            $response = $this->respondDeleted('Rewards successfully deleted.');
        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Rewards to be deleted not found.', 1404);

        }

        return $response;
    }

} 

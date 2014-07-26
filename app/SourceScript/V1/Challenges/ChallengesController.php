<?php  namespace SourceScript\V1\Challenges;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use SourceScript\V1\API\ApiController;
use SourceScript\V1\Challenges\Validators\ChallengesCreateValidator;
use SourceScript\V1\Challenges\Validators\ChallengesUpdateValidator;
use Input;

class ChallengesController extends ApiController {

    protected $ChallengesRepository;
    protected $ChallengesTransformer;
    private $ChallengesCreateValidator;
    private $ChallengesUpdateValidator;

    public function __construct(
        EloquentChallengesRepository $ChallengesRepository,
        ChallengesTransformer $ChallengesTransformer,
        ChallengesCreateValidator $ChallengesCreateValidator,
        ChallengesUpdateValidator $ChallengesUpdateValidator
    )
    {
        $this->ChallengesRepository = $ChallengesRepository;
        $this->ChallengesTransformer = $ChallengesTransformer;
        $this->ChallengesCreateValidator = $ChallengesCreateValidator;
        $this->ChallengesUpdateValidator = $ChallengesUpdateValidator;
    }

    public function index()
    {
        $limit = Input::get('limit') ?: 10;
        $limit = ($limit <= 50) ? $limit : 50;

        $Challengess = $this->ChallengesRepository->paginate($limit);

        $transformedData = $this->ChallengesTransformer->transformCollection($Challengess);

        return $this->respondCollection($Challengess, $transformedData);
    }

    public function store()
    {
        $input = Input::only([]);

        if($Challenges = $this->ChallengesRepository->create($input, $this->ChallengesCreateValidator)) {
            $transformedData = $this->ChallengesTransformer->transform($Challenges);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->ChallengesCreateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function show($id)
    {
        try {
            $Challenges = $this->ChallengesRepository->findOrFail($id);
            $transformedData = $this->ChallengesTransformer->transform($Challenges);

            $response = $this->respondItem($transformedData);

        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Challenges not found.', 1404);

        }

        return $response;
    }

    public function update($id)
    {
        $input = Input::only([]);

        if($Challenges = $this->ChallengesRepository->update($input, $id, $this->ChallengesUpdateValidator->setId($id))) {
            $transformedData = $this->ChallengesTransformer->transform($Challenges);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->ChallengesUpdateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function destroy($id)
    {
        try {
            $this->ChallengesRepository->delete($id);

            $response = $this->respondDeleted('Challenges successfully deleted.');
        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Challenges to be deleted not found.', 1404);

        }

        return $response;
    }

} 

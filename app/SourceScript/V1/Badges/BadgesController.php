<?php  namespace SourceScript\V1\Badges;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use SourceScript\V1\API\ApiController;
use SourceScript\V1\Badges\Validators\BadgesCreateValidator;
use SourceScript\V1\Badges\Validators\BadgesUpdateValidator;
use Input;

class BadgesController extends ApiController {

    protected $BadgesRepository;
    protected $BadgesTransformer;
    private $BadgesCreateValidator;
    private $BadgesUpdateValidator;

    public function __construct(
        EloquentBadgesRepository $BadgesRepository,
        BadgesTransformer $BadgesTransformer,
        BadgesCreateValidator $BadgesCreateValidator,
        BadgesUpdateValidator $BadgesUpdateValidator
    )
    {
        $this->BadgesRepository = $BadgesRepository;
        $this->BadgesTransformer = $BadgesTransformer;
        $this->BadgesCreateValidator = $BadgesCreateValidator;
        $this->BadgesUpdateValidator = $BadgesUpdateValidator;
    }

    public function index()
    {
        $limit = Input::get('limit') ?: 10;
        $limit = ($limit <= 50) ? $limit : 50;

        $Badgess = $this->BadgesRepository->paginate($limit);

        $transformedData = $this->BadgesTransformer->transformCollection($Badgess);

        return $this->respondCollection($Badgess, $transformedData);
    }

    public function store()
    {
        $input = Input::only([]);

        if($Badges = $this->BadgesRepository->create($input, $this->BadgesCreateValidator)) {
            $transformedData = $this->BadgesTransformer->transform($Badges);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->BadgesCreateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function show($id)
    {
        try {
            $Badges = $this->BadgesRepository->findOrFail($id);
            $transformedData = $this->BadgesTransformer->transform($Badges);

            $response = $this->respondItem($transformedData);

        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Badges not found.', 1404);

        }

        return $response;
    }

    public function update($id)
    {
        $input = Input::only([]);

        if($Badges = $this->BadgesRepository->update($input, $id, $this->BadgesUpdateValidator->setId($id))) {
            $transformedData = $this->BadgesTransformer->transform($Badges);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->BadgesUpdateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function destroy($id)
    {
        try {
            $this->BadgesRepository->delete($id);

            $response = $this->respondDeleted('Badges successfully deleted.');
        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Badges to be deleted not found.', 1404);

        }

        return $response;
    }

} 

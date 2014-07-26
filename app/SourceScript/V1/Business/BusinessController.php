<?php  namespace SourceScript\V1\Business;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use SourceScript\V1\API\ApiController;
use SourceScript\V1\Business\Validators\BusinessCreateValidator;
use SourceScript\V1\Business\Validators\BusinessUpdateValidator;
use Input;

class BusinessController extends ApiController {

    protected $BusinessRepository;
    protected $BusinessTransformer;
    private $BusinessCreateValidator;
    private $BusinessUpdateValidator;

    public function __construct(
        EloquentBusinessRepository $BusinessRepository,
        BusinessTransformer $BusinessTransformer,
        BusinessCreateValidator $BusinessCreateValidator,
        BusinessUpdateValidator $BusinessUpdateValidator
    )
    {
        $this->BusinessRepository = $BusinessRepository;
        $this->BusinessTransformer = $BusinessTransformer;
        $this->BusinessCreateValidator = $BusinessCreateValidator;
        $this->BusinessUpdateValidator = $BusinessUpdateValidator;
    }

    public function index()
    {
        $limit = Input::get('limit') ?: 10;
        $limit = ($limit <= 50) ? $limit : 50;

        $Businesss = $this->BusinessRepository->paginate($limit);

        $transformedData = $this->BusinessTransformer->transformCollection($Businesss);

        return $this->respondCollection($Businesss, $transformedData);
    }

    public function store()
    {
        $input = Input::only([]);

        if($Business = $this->BusinessRepository->create($input, $this->BusinessCreateValidator)) {
            $transformedData = $this->BusinessTransformer->transform($Business);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->BusinessCreateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function show($id)
    {
        try {
            $Business = $this->BusinessRepository->findOrFail($id);
            $transformedData = $this->BusinessTransformer->transform($Business);

            $response = $this->respondItem($transformedData);

        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Business not found.', 1404);

        }

        return $response;
    }

    public function update($id)
    {
        $input = Input::only([]);

        if($Business = $this->BusinessRepository->update($input, $id, $this->BusinessUpdateValidator->setId($id))) {
            $transformedData = $this->BusinessTransformer->transform($Business);
            $response = $this->respondCreated($transformedData);
        } else {
            $details = $this->BusinessUpdateValidator->getMessages()->toArray();
            $response = $this->respondValidatorError('Validation Error.', '1500', $details);
        }

        return $response;
    }

    public function destroy($id)
    {
        try {
            $this->BusinessRepository->delete($id);

            $response = $this->respondDeleted('Business successfully deleted.');
        } catch (ModelNotFoundException $exception) {

            $response = $this->respondModelNotFound('Business to be deleted not found.', 1404);

        }

        return $response;
    }

} 

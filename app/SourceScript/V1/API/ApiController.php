<?php  namespace SourceScript\V1\API;

use BaseController, Response;
use Illuminate\Pagination\Paginator;

abstract class ApiController extends BaseController {
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    protected $responseFormatter;

    public function __construct(ResponseFormatter $responseFormatter)
    {
        $this->responseFormatter = $responseFormatter;
    }

    public function respondCollection(Paginator $collection, $data, $headers = [])
    {
        $code = 200;

        $respondData = [
            'data' => $data,
            'paginator' => [
                'current_page' => $collection->getCurrentPage(),
                'limit' => $collection->getPerPage(),
                'total_count' => $collection->getTotal(),
                'total_pages' => ceil($collection->getTotal() / $collection->getPerPage()),
                'count' => $collection->count()
            ],
            'status' => self::STATUS_SUCCESS
        ];

        return $this->respond($respondData, $code, $headers);
    }

    public function respondItem($data, $headers = [])
    {
        $code = 200;

        $respondData = [
            'data' => $data,
            'status' => self::STATUS_SUCCESS
        ];

        return $this->respond($respondData, $code, $headers);
    }

    public function respondCreated($data, $headers = [])
    {
        $code = 201;

        $respondData = [
            'data' => $data,
            'status' => self::STATUS_SUCCESS
        ];

        return $this->respond($respondData, $code, $headers);
    }

    public function respondDeleted($message, $headers = [])
    {
        $code = 200;

        $respondData = [
            'message' => $message,
            'status' => self::STATUS_SUCCESS
        ];

        return $this->respond($respondData, $code, $headers);
    }

    public function respondModelNotFound($message, $errorCode, $headers = [])
    {
        $code = 404;

        $responseData = [
            'message' => $message,
            'code' => $errorCode,
            'status' => self::STATUS_ERROR
        ];

        return $this->respond($responseData, $code, $headers);
    }

    public function respondValidatorError($message, $errorCode, $details, $headers = [])
    {
        $code = 500;

        $responseData = [
            'message' => $message,
            'detail' => $details,
            'code' => $errorCode,
            'status' => self::STATUS_ERROR
        ];

        return $this->respond($responseData, $code, $headers);
    }

    public function respond($data, $code = 200, $headers = [])
    {
        return Response::json($data, $code, $headers);
    }


}
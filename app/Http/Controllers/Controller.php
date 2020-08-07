<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Controller extends BaseController {

    public function success($data, $code = 200, $message = null, $meta = null) {
        $response = array(
            'status' => true,
            'request_status' => true,
            'message' => $message ?: 'Successful response',
            'code' => $code,
            'record' => $data,
            'meta' => $meta
        );
        return response()->json($response, $code);
    }

    public function error($errors, $code = 400, $error_code = '', $message = null, $meta = null) {
        $message = $message ?: 'Bad Request';
        $response = array(
            'status' => false,
            'request_status' => true,
            'message' => $message,
            'code' => $code,
            'error' => array(
                'code' => $error_code,
                'detail' => $errors,
                'html' => "<div class='laravel-errors'>$message</div>",
            ),
            'meta' => $meta
        );
        if ($error_code === 'VALIDATION_ERROR') {
            $errorsFlat = Arr::flatten((array) $errors);
            $response['error']['html'] = '<ul class="laravel-errors-list">';
            foreach ($errorsFlat as $err) {
                $response['error']['html'] .= "<li>$err</li>";
            }
            $response['error']['html'] .= '</ul>';
        }
        return response()->json($response, $code);
    }

    protected function buildFailedValidationResponse(Request $request, array $errors) {
        if (isset(static::$responseBuilder)) {
            return call_user_func(static::$responseBuilder, $request, $errors);
        }

        return $this->error($errors, 422, 'VALIDATION_ERROR', 'Validation Error');
    }

    public function validationError($errors, $message = null) {
        return $this->error($errors, 422, 'VALIDATION_ERROR', $message);
    }

    public function listResponse($data, $meta) {
        return $this->success($data, 200, null, $meta);
    }

}

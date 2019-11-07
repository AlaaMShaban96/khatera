<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Session;

class AppCustomException extends Exception
{
    private $http_code;
    private $error_message;
    private $error_code;
    private $validation_errors;

    public function construct($message, $code, $validation_errors = null)
    {
        $this->http_code = $code;
        $this->error_message = ('app_custom_errors.' . $message . '.message');
        $this->error_code = __('app_custom_errors.' . $message . '.code');
        $this->validation_errors = $validation_errors;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        if (request()->wantsJson()) {
            return response()->json(
                [
                    'error' => [
                        'code'    => (int) $this->error_code,
                        'message' => $this->error_message,
                        'errors'  => $this->validation_errors
                    ],
                ],
                $this->http_code
            );
        } else {
            Session::flash('error', $this->error_message);
            return redirect()->back();
        }
    }
}

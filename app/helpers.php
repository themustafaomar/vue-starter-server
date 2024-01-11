<?php

if (! function_exists('ok')) {
    /**
     * Send standarized success response
     * 
     * @param array $data
     * @param int $status_code
     * @return \Illuminate\Http\Response
     */
    function ok($data = [], $status_code = 200)
    {
        return response()->json(
            array_merge(['status' => 'OK'], $data), $status_code
        );
    }
}

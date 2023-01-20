<?php

declare(strict_types=1);

namespace App\Ship\Parents\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest as IlluminateFormRequest;

abstract class Request extends IlluminateFormRequest
{
    /**
     * Maps Keys in the Request.
     *
     * For example, ['data.attributes.name' => 'firstname'] would map the field [data][attributes][name] to [firstname].
     * Note that the old value (data.attributes.name) is removed the original request - this method manipulates the request!
     * Be sure you know what you do!
     *
     * @param array $fields
     * @throws IncorrectIdException
     */
    public function mapInput(array $fields): void
    {
        $data = $this->all();

        foreach ($fields as $oldKey => $newKey) {
            // the key to be mapped does not exist - skip it
            if (!Arr::has($data, $oldKey)) {
                continue;
            }

            // set the new field and remove the old one
            Arr::set($data, $newKey, Arr::get($data, $oldKey));
            Arr::forget($data, $oldKey);
        }

        // overwrite the initial request
        $this->replace($data);
    }

    /**
     * Overriding this function to modify the any user input before
     * applying the validation rules.
     *
     * @param null $keys
     *
     * @return  array
     * @throws IncorrectIdException
     */
    public function all($keys = null): array
    {
        $requestData = parent::all($keys);

        return $this->mergeUrlParametersWithRequestData($requestData);
    }

    /**
     * apply validation rules to the ID's in the URL, since Laravel
     * doesn't validate them by default!
     *
     * Now you can use validation rules like this: `'id' => 'required|integer|exists:items,id'`
     *
     * @param array $requestData
     *
     * @return  array
     */
    private function mergeUrlParametersWithRequestData(array $requestData): array
    {
        if (isset($this->urlParameters) && !empty($this->urlParameters)) {
            foreach ($this->urlParameters as $param) {
                $requestData[$param] = $this->route($param);
            }
        }

        return $requestData;
    }

    /**
     * This method mimics the $request->input() method but works on the "decoded" values
     *
     * @param $key
     * @param $default
     *
     * @return mixed
     * @throws IncorrectIdException
     */
    public function getInputByKey($key = null, $default = null): mixed
    {
        return data_get($this->all(), $key, $default);
    }
}

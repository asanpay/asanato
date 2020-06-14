<?php


namespace App\Ship\Traits;


trait JsonbField
{
    /**
     * @param string $fieldName
     * @param bool $assoc return json_decode result as associative array or object
     *
     * @return array
     */
    public function getJsonb(string $fieldName = 'meta', $assoc = true): array
    {
        if (is_array($this->{$fieldName})) {
            return $this->{$fieldName};
        }
        return json_decode($this->{$fieldName}, $assoc);
    }

    /**
     * get the value of jsonb key
     * @param string $key
     * @param string $fieldName
     *
     * @return |null
     */
    public function getFromJsonb(string $key, string $fieldName = 'meta')
    {
        $jsonB = $this->getJsonb($fieldName);
        return $jsonB[$key] ?? null;
    }

    /**
     * @param array $arr
     * @param bool $save
     * @param string $fieldName
     *
     * @return bool
     */
    public function setJsonb(array $arr = [], bool $save = true, string $fieldName = 'meta'): bool
    {
        $this->{$fieldName} = $arr;
        if ($save) {
            return $this->save();
        }

        return true;
    }

    /**
     * @param string $key
     * @param $value
     * @param bool $save
     * @param string $fieldName
     *
     * @return bool
     */
    public function addToJsonb(string $key, $value, bool $save = true, string $fieldName = 'meta'): bool
    {
        $json = $this->getJsonb($fieldName, true);
        $json[$key] = $value;

        $this->{$fieldName} = $json;
        if ($save) {
            return $this->save();
        }

        return true;
    }

    /**
     * @param string $key
     * @param bool $save
     * @param string $fieldName
     *
     * @return bool
     */
    public function removeFromJsonb(string $key, bool $save = true, string $fieldName = 'meta'): bool
    {
        $json = json_decode($this->{$fieldName}, true);
        if (isset($json[$key])) {
            unset($json[$key]);
            return $this->setJsonb($json, $save, $fieldName);
        } else {
            return true;
        }
    }
}

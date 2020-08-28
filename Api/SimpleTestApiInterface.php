<?php

namespace TestTask\SimpleTest\Api;

interface SimpleTestApiInterface {

    /**
     * GET json for SimpleTestAPI.
     * 
     * Return json string.
     * 
     * @return string
     */
    public function getJson();

    /**
     * GET array for SimpleTestAPI.
     *
     * Return array of arrays.
     * 
     * @return array
     */
    public function getArrayOfArrays();

    /**
     * GET object for SimpleTestAPI.
     * 
     * Return array of objects CustomStoreInterface.
     * 
     * @return \TestTask\SimpleTest\Api\Data\CustomStoreInterface[]
     */
    public function getArrayOfObjects();
}

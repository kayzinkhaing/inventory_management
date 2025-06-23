<?php

// app/Traits/HasCustomVariables.php

namespace App\Helper;

class CustomVariables
{
    /**
     * Store custom variables in an array.
     */
    private $customVariables = [];

    /**
     * Constructor to load the custom values from the config file.
     */
    public function __construct()
    {
        // Load all the custom variables from the config
        $this->customVariables = config('custom_variables');
        //dd($this->customVariables);
    }

    /**
     * Magic method to access custom variables dynamically as properties.
     */
    public function __get($name) //Megic Method
    {
        // Check if the custom variable exists in the config values array
        if (array_key_exists($name, $this->customVariables)) {
            return $this->customVariables[$name];
        }
        // Return null if the property is not found
        // Or you can throw an exception if needed
        return null;
    }
}

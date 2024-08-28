<?php

namespace Studio\Totem;

class CleanOutput
{
    /**
     * Clean unwanted string and lines.
     *
     * @param  string  $output
     * @return string
     */
    public static function cleanOutput($output)
    {
        // Remove unwanted characters (example: removing extra newlines and spaces)
        $cleanedOutput = trim($output); // Trim leading and trailing spaces
        $cleanedOutput = preg_replace('/\s+/', ' ', $cleanedOutput); // Replace multiple spaces with a single space

        // You can add more cleaning logic here if needed

        return $cleanedOutput;
    }
}

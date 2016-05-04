<?php namespace Helpers;
  
  /**
   * 
   */
  class ArrayHelper
  {
    /**
     *
     *
     */
    public static function insertAt(array &$array, $pos, $value)
    {
        $maxIndex = count($array)-1;

        if ($pos === 0)
        {
            array_unshift($array, $value);
        } 
        elseif (($pos > 0) && ($pos <= $maxIndex))
        {
            $firstHalf = array_slice($array, 0, $pos);
            $secondHalf = array_slice($array, $pos);
            $array = array_merge($firstHalf, array($value), $secondHalf);
        }
        else
        {
            throw new \OutOfBoundsException;
        }

    }

  }
  
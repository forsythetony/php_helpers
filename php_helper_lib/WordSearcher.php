<?php
    
    include("StringHelpers.php");


    class WordSearcher
    {
        private $searchKeys;
        private $results;

        function __construct()
        {
            $this->searchKeys = array();
            $this->results = new WordSearcherResults();
        }    

        public function addSearchKey( $key )
        {
            $this->searchKeys[] = $key;

            $this->results->addKey( $key->key );
        }

        public function addSearchKeys( $keys )
        {
            foreach($keys as $key)
            {
                $this->addSearchKey($key);
            }
        }


        public function getResultsFromString( $str )
        {
            $this->results->resetValues();
            $str = strtolower($str);

            foreach($this->searchKeys as $searchKey)
            {
                $permCount = count($searchKey->searchKeys);
                $negCount = count($searchKey->negators);

                echo json_encode($searchKey->searchKeys->backingArray);

                $permIndex = 0;
                
                $foundPositiveHit = false;

                for($permIndex = 0; $permIndex < $permCount; $permIndex++)
                {

                    $perm = $searchKey->searchKeys->getValueForIndex($permIndex);

                    //  See if there are any occurences of the permutation
                    echo "Perm => $perm";
                    $strPos = strpos($str , $perm);

                    
                    if($strPos !== false)
                    {
                        //  Get rewind position
                        $rewindPos = getRewindPositionOfWord($str, " ", 6, $perm);

                        //  Now check for negators
                        $negIndex = 0;

                        $foundNegHit = false;

                        for($negIndex = 0; $negIndex < $negCount; $negIndex++)
                        {
                            $negValue = $searchKey->negators->getValueForIndex($negIndex);

                            $subStr = substr($str, $rewindPos, $strPos - $rewindPos);

                            $negStrPos = strpos($subStr, $negValue);

                            if($negStrPos !== false)
                            {
                                
                                $foundNegHit = true;
                                break;
                            }
                        }

                        if($foundNegHit !== true)
                        {
                            $foundPositiveHit = true;
                        }

                    }



                }

                if($foundPositiveHit)
                {
                    $this->results->incrementValueForKey($searchKey->key);
                }
            }



            return $this->results;

        }
    }




    class WordSearcherResults
    {
        private $resultSet;

        function __construct()
        {
            $this->resultSet = array();
        }

        public function addKey( $key )
        {
            $this->resultSet[$key] = 0;
        }

        public function resetValues()
        {
            foreach($this->resultSet as $key => $value)
            {
                $this->resultSet[$key] = 0;
            }
        }

        public function incrementValueForKey( $key )
        {
            $this->resultSet[$key] += 1;
        }

        public function getLogString()
        {
            return json_encode($this->resultSet);
        }
    }








    

    class SearchKey
    {
        public $searchKeys;
        public $negators;
        public $key;

        function __construct($k )
        {
            $this->searchKeys = new WordArray();
            $this->negators = new WordArray();
            $this->key = $k;
        }
        
        public function addSearchKeyPermutations( $perms )
        {
            foreach($perms as $perm)
            {
                $this->searchKeys->addValue( $perm );
            }
        }

        public function addNegatorPermutations( $perms )
        {
            foreach($perms as $perm)
            {
                 $this->negators->addValue( $perm );
            }
        }
    }
    //
    //    UTILITY CLASSES
    //

    class WordArray implements Countable
    {
        public $backingArray;

        function __construct()
        {
            $this->backingArray = array();
        }




        public function addValue( $val )
        {
            //$value = padStringWithChar($val, " ", true);

            $this->backingArray[] = $val;
        }
        public function getValueForIndex( $i )
        {
            if ($i < count($this->backingArray) && $i >= 0)
            {
                return $this->backingArray[$i];
            }
        }
        //  Countable Functions
        public function count()
        {
            return count($this->backingArray);
        }

        

    }
?>
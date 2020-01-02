<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;

class PaginatedLinks
{
        /**
     * The Elipsis Character.
     *
     * @var string
     */
    public $elipsisCharacter = '....';
    /**
     * The PaginatorInstance.
     *
     * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public $lengthAwarePaginator;
    /**
     * Get the value of elipsisCharacter
     */ 
    public function getElipsisCharacter()
    {
        return $this->elipsisCharacter;
    }
    /**
     * Set the value of elipsisCharacter
     *
     * @return  self
     */ 
    public function setElipsisCharacter($elipsisCharacter)
    {
        $this->elipsisCharacter = $elipsisCharacter;
        return $this;
    }
    /**
     * Get the PaginatorInstance.
     *
     * @return  LengthAwarePaginator
     */ 
    public function getPaginatorInstance()
    {
        return $this->lengthAwarePaginator;
    }
    /**
     * Set the PaginatorInstance.
     *
     * @param  LengthAwarePaginator  $lengthAwarePaginator.
     *
     * @return  self
     */ 
    public function setPaginatorInstance(LengthAwarePaginator $lengthAwarePaginator)
    {
        $this->lengthAwarePaginator = $lengthAwarePaginator;
        return $this;
    }
    /**
     * Convert the Paginator Insnatance to formatted array
     *
     *
     * @return array|null
     **/
    public function get()
    {
        $window = UrlWindow::make($this->getPaginatorInstance());
        $array =  array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);
            $i = 1;
        foreach($array as $index => $urlsArray):
            if(is_array($urlsArray)):
                foreach($urlsArray as $pageNumber => $link):
                    $currentPage = $this->getPaginatorInstance()->currentPage();
                    $n[] = [
                        'pageNumber' => $pageNumber,
                        'url' => $link,
                        'indexKey' => $i,
                        'type' => 'URLS',
                        'isCurrentPage' => $currentPage === $pageNumber,
                    ];
                    $i++;
                endforeach;
                elseif(is_string($urlsArray)):
                    $n[] = [
                        'url' => $urlsArray,
                        'indexKey' => $i,
                        'type' => 'ELIPSIS',
                    ];
                    $i++;
            endif;
        endforeach;

        // $methodsTobePassed = [
        //     'hasMorePages',
        //     'nextPageUrl',
        //     'previousPageUrl',
        //     'currentPage',
        // ];
        
        // foreach($methodsTobePassed as $eachMethod):
        //     $methods[$eachMethod] = $this
        //             ->lengthAwarePaginator->$eachMethod();
        // endforeach;


        return count($n) === 1 ? null : $n;
    }
}
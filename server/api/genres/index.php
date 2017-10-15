<?php
include '../../app/lib/function.php';
class Genres extends RestServer
{
    private $model;
    private $response;

    /**
     * create obj - model & response
     * parent run method
     * Authors constructor.
     */
    public function __construct()
    {
        $this->model = new ModelGenres();
        $this->response = new Response();
        $this->run();
    }

    public function getGenres($param=false)
    {
        try
        {
            if ($param !== false)
            {
                $result = $this->model->getGenres($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->getGenres();
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch(Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }

    }
}
$books = new Genres();
<?php
include '../../app/lib/function.php';
class Booktoauthor extends RestServer
{
    private $model;
    private $response;

    /**
     * create obj - model & response
     * parent run method
     * Genres constructor.
     */
    public function __construct()
    {
        $this->model = new ModelBooktoauthor();
        $this->response = new Response();
        $this->run();
    }

    public function getBooktoauthor($param=false){
        try
        {
            if ($param !== false)
            {
                $result = $this->model->getIds($param);
                $result = $this->encodedData($result);
                return $this->response->serverSuccess(200, $result);
            }
            $result = $this->model->getIds();
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch(Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function postBooktoauthor($param)
    {
        try
        {
            $result = $this->model->addBookToAuthor($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }

    public function deleteBooktoauthor($param)
    {
        try
        {
            $result = $this->model->deleteById($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }
}
$books = new Booktoauthor();
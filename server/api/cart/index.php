<?php
include '../../app/lib/function.php';
class Cart extends RestServer
{
    private $model;
    private $response;

    /**
     * create obj - model & response
     * parent run method
     * Books constructor.
     */
    public function __construct()
    {
        $this->model = new ModelCart();
        $this->response = new Response();
        $this->run();
    }

    public function getCart($param)
    {
        try
        {
            $result = $this->model->getBooksByIdClient($param);
            $result = $this->encodedData($result);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }


    public function postCart($param)
    {
        try
        {
            $result = $this->model->addToCart($param);
            return $this->response->serverSuccess(200, $result);
        }
        catch (Exception $exception)
        {
            return $this->response->serverError(500, $exception->getMessage());
        }
    }


//    public function getBooks($param=false)
//    {
//        try
//        {
//            if ($param !== false)
//            {
//                $result = $this->model->getBooks($param);
//                $result = $this->encodedData($result);
//                return $this->response->serverSuccess(200, $result);
//            }
//            $result = $this->model->getBooks();
//            $result = $this->encodedData($result);
//            return $this->response->serverSuccess(200, $result);
//        }
//        catch(Exception $exception)
//        {
//            return $this->response->serverError(500, $exception->getMessage());
//        }
//
//    }
}
$books = new Cart();